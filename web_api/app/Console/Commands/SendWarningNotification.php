<?php

namespace App\Console\Commands;

use App\Http\Services\FirebaseService;
use App\Models\MonitorPlace;
use App\Models\RiskUser;
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
        RiskUser::where('created_at', '<', now()->subMinutes(5))->get()->each(function ($monitorPlace) {
            Log::alert($monitorPlace);

            $deviceToken = '
eL96CU4TRR6s04r2-4KPfH:APA91bGiVJFSC47ZpZnuYZBhh9L2sbnc8fORyJphj2BFlL1IoZd-Q5GhNrF28mii2wU9kBycb5_OVL52vbd9GaUPzMUAM18fxii_jJ55l662a0X9zB0YnCM';
            $title = 'title';
            $message = 'message';

            $firebaseService = new FirebaseService();
            $firebaseService->sendNotification($deviceToken, $title, $message, []);

            $url = 'http://192.168.8.195:8080:8080/message';
            $username = 'sms';
            $password = '52naxytP';

            $data = [
                "message" => "Hello, doctors!",
                "phoneNumbers" => ["+19162255887", "+19162255888"]
            ];

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($ch);

            if ($response === false) {
                $error = curl_error($ch);
                Log::info("cURL Error: $error");
            } else {
                Log::error("Response: $response");
            }

            curl_close($ch);
        });
    }
}
