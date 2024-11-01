<?php

namespace App\Console\Commands;

use App\Models\MonitorPlace;
use App\Services\FirebaseService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendWarningNotification extends Command
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }
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
    protected $description = 'Command description';

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
            $data = 'data'; // Optional custom data payload

            $success = $this->firebaseService->sendNotification($deviceToken, $title, $message, $data);

            if ($success) {
                return response()->json(['message' => 'Notification sent successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to send notification'], 500);
            }
        });
    }
}
