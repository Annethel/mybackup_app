<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;

class FirebaseService
{
    protected $client;
    protected $projectId;

    public function __construct()
    {
        $serviceAccountPath = storage_path('app/firebase-service-account.json');

        $this->client = new Client();
        $this->client->setAuthConfig($serviceAccountPath);
        $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $json = json_decode(file_get_contents($serviceAccountPath), true);
        $this->projectId = $json['project_id'];
    }

    public function sendToDevice(string $token, array $notification, array $data = [])
    {
        $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];

        $response = Http::withToken($accessToken)
            ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", [
                'message' => [
                    'token' => $token,
                    'notification' => $notification,
                    'data' => $data,
                    'android' => ['priority' => 'high'],
                    'apns' => ['headers' => ['apns-priority' => '10']],
                ]
            ]);

        return $response->json();
    }
}

