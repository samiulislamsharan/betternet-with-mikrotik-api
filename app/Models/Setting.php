<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;


/**
 * Setting
 *
 * @mixin Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'router_ip',
        'router_username',
        'router_password',
        'mail_server',
        'mail_username',
        'mail_password',
        'mail_port',
        'bill_at',
        'app_name',
        'timezone',
        'currency',
    ];

    public static function loadSettings()
    {
        $settings = self::firstOrFail();

        Config::set('app.name', $settings->app_name ? $settings->app_name : 'Betternet');
        Config::set('app.timezone', $settings->timezone ? $settings->timezone : 'UTC');
    }
}
