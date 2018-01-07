<?php

namespace App\Services;

use GuzzleHttp\Client;

class JailService
{
    /** @var Mailer */
    private $client;

    /**
     * EmailService constructor.
     * @param Mailer $mail
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('app.jail_api_url'),
        ]);
    }

    public function getJailsStatus()
    {
        try {
            $response = $this->client->request('GET', '/list');
            return [
                'success' => true,
                'data' => json_decode($response->getBody()),
            ];
        } catch (\Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody(true);
            $res = json_decode($responseBodyAsString);
            return [
                'success' => false,
                'error' => $res->message,
            ];
        }
    }

    public function createJail($hostname, $ip, $quota, $sshKey)
    {
        try {
            $response = $this->client->request('POST', '/create', [
                'json' => [
                    'name' => $hostname,
                    'ip' => $ip,
                    'quota' => $quota,
                    'sshkey' => $sshKey,
                ]
            ]);
            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody(true);
            $res = json_decode($responseBodyAsString);
            return [
                'success' => false,
                'error' => $res->message,
            ];
        }
    }
}