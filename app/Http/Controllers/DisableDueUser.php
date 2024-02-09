<?php

namespace App\Http\Controllers;

use App\Models\User;
use RouterOS\Client;
use RouterOS\Query;

class DisableDueUser extends Controller
{
    public function __invoke()
    {
        $users = User::all();

        try {
            $client = new Client([
                "host" => get_setting('router_ip'),
                "user" => get_setting('router_username'),
                "pass" => get_setting('router_password'),
            ]);

            foreach ($users as $user) {
                if ($user->due_amount($user->id) > 0) {
                    $query = new Query("/ppp/secret/disable");
                    $query->equal("numbers", $user->name);
                    $client->query($query)->read();
                    $user->detail->update(["status" => 'inactive']);
                }
            }

        }  catch (\Exception $e) {
            return back()->with("error", __("Mikrotik connection fails"));
        }

        return back();
    }
}
