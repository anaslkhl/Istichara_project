<?php

namespace Services;

use GuzzleHttp\Client;

class ZoomService
{
    private Client $client;
    private string $accessToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->accessToken = 'test';

    }

    private function generateToken(): string
    {
        $response = $this->client->post(
            'https://zoom.us/oauth/token',
            [
                'auth' => [
                    $_ENV['ZOOM_CLIENT_ID'],
                    $_ENV['ZOOM_CLIENT_SECRET']
                ],
                'form_params' => [
                    'grant_type' => 'account_credentials',
                    'account_id' => $_ENV['ZOOM_ACCOUNT_ID']
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function createMeeting(string $topic, string $startTime, int $duration = 30): string
    {
        $response = $this->client->post(
            'https://api.zoom.us/v2/users/me/meetings',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'topic' => $topic,
                    'type' => 2,
                    'start_time' => $startTime,
                    'duration' => $duration,
                    'timezone' => 'Africa/Casablanca'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);
        return $data['join_url'];
    }
}
