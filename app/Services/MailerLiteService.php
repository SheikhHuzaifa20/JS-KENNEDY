<?php

namespace App\Services;

use MailerLite\MailerLite;

class MailerLiteService
{
    protected $subscribersApi;
    protected $groupId;

    public function __construct()
    {
        $mailerlite = new MailerLite(['api_key' => config('services.mailerlite.key')]);
        $this->subscribersApi = $mailerlite->subscribers();
        $this->groupId = config('services.mailerlite.group_id');
    }

    public function subscribe($email, $name = null)
    {
        try {
            $subscriberData = [
                'email' => $email,
                'fields' => [
                    'name' => $name,
                ],
            ];

            if ($this->groupId) {
                return $this->subscribersApi->createOrUpdate($subscriberData, $this->groupId);
            }

            return $this->subscribersApi->createOrUpdate($subscriberData);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
