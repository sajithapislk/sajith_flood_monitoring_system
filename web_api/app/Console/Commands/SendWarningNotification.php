<?php

namespace App\Console\Commands;

use App\Models\MonitorPlace;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SendWarningNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:warning-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a warning notification to devices.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        MonitorPlace::where('updated_at', '<', now()->subMinutes(5))->get()->each(function ($monitorPlace) {
            Log::alert($monitorPlace);

            $deviceToken = 'device_token';
            $title = 'title';
            $message = 'message';
            $data = ['custom_key' => 'custom_value']; // Custom data payload if needed

            // Prepare Firebase notification payload
            $notificationPayload = [
                'to' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $message,
                ],
                'data' => $data,
            ];

            // Send notification using Laravel's HTTP client
            $response = Http::withHeaders([
                'Authorization' => 'key=YOUR_FIREBASE_SERVER_KEY',
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', $notificationPayload);

            if ($response->successful()) {
                Log::info('Notification sent successfully');
            } else {
                Log::error('Failed to send notification', ['response' => $response->body()]);
            }
        });
    }
}
