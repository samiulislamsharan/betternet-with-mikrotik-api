<?php

use App\Models\Setting;

if (! function_exists('get_setting')) {
    function get_setting($key)
    {
        $setting = Setting::first();
        return $setting ? $setting->{$key} : null;
    }
}

