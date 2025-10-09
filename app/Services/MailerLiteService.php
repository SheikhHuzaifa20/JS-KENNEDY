<?php

namespace App\Services;

use MailerLite\MailerLite;

class MailerLiteService
{
    protected $client;

    public function __construct()
    {
        $this->client = new MailerLite([
            'api_key' => env('MAILERLITE_API_KEY'),
        ]);
    }

    public function subscribe($email, $name = null)
    {
        try {
            $subscribersApi = $this->client->subscribers;

            $subscriberData = [
                'email' => $email,
                'fields' => [
                    'name' => $name,
                ],
            ];

            // Create or update subscriber
            return $subscribersApi->createOrUpdate($subscriberData);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
