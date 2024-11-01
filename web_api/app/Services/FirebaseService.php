<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseService
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = env('FIREBASE_SERVER_KEY'); // Add the server key in your .env file
    }

    /**
     * Send a notification to a specific device via FCM
     *
     * @param  string  $deviceToken
     * @param  string  $title
     * @param  string  $message
     * @param  array   $data
     * @return bool
     */
    public function sendNotification($deviceToken, $title, $message, $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            'to' => $deviceToken, // Device Token
            'notification' => [
                'title' => $title,
                'body'  => $message,
            ],
            'data' => $data, // Custom data payload if needed
        ];

        $headers = [
            'Authorization' => 'key=' . $this->serverKey,
            'Content-Type'  => 'application/json',
        ];

        $client = new Client();

        $response = $client->post($url, [
            'headers' => $headers,
            'json'    => $fields,
        ]);

        return $response->getStatusCode() === 200;
    }
}
