<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class OpenIAController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/chat/completions',
        ]);
    }

    public function sendMenssage($message)
    {
        $response = $this->client->post('completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // El modelo que desees usar
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $message,
                    ],
                ],
                'temperature' => 0.7, // Controla la creatividad de la respuesta
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
