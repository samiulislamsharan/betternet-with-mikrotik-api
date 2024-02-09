<?php

namespace App\Http\Controllers;

use RouterOS\Client;
use RouterOS\Query;

class Log extends Controller
{
    public function __invoke()
    {
        try {
            $client = new Client([
                "host" => get_setting('router_ip'),
                "user" => get_setting('router_username'),
                "pass" => get_setting('router_password'),
            ]);

            $query = new Query("/log/print");
            $logs = $client->query($query)->read();
        } catch (\Exception $e) {
            return back()->with("error", __("Mikrotik connection fails"));
        }

        return view('log', compact('logs'));
    }
}
