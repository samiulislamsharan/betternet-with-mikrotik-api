<?php

namespace App\Http\Controllers;

use App\Models\User;
use RouterOS\Client;
use RouterOS\Query;

class UserDisable extends Controller
{
    public function __invoke(User $user)
    {
        try {
            $client = new Client([
                "host" => get_setting('router_ip'),
                "user" => get_setting('router_username'),
                "pass" => get_setting('router_password'),
            ]);

            $query = new Query("/ppp/secret/disable");
            $query->equal("numbers", $user->name);
            $client->query($query)->read();
        } catch (\Exception $e) {
            return back()->with("error", __("Mikrotik connection fails"));
        }

        $user->detail->update(["status" => 'inactive']);
        return back();
    }
}
