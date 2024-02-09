<?php


namespace App\Classes;

use Exception;
use RouterOS\Client;
use RouterOS\Query;

class Mikrotik
{
    public function checkConnection()
    {
        try {
            $client = new Client([
                'host' => get_setting('router_ip'),
                'user' => get_setting('router_username'),
                'pass' => get_setting('router_password') ?: ''
            ]);

            $client->query(new Query('/system/resource/print'));
            return $client;
        } catch (Exception $exception) {
            return null;
        }
    }
}
