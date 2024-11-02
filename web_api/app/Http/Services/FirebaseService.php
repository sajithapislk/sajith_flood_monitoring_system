<?php
namespace App\Http\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/flood-system-c44c3-firebase-adminsdk-y4rt4-dad4f4c013.json'));

        $this->messaging = $firebase->createMessaging();
    }

    public function sendNotification(string $deviceToken, string $title, string $message, array $data = []): bool
    {
        $notification = [
            'title' => $title,
            'body' => $message,
        ];

        $cloudMessage = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification)
            ->withData($data);

        try {
            $this->messaging->send($cloudMessage);
            Log::info('Notification sent successfully');
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send notification', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
