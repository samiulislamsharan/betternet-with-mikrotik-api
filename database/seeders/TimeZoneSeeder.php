<?php

namespace Database\Seeders;

use App\Models\TimeZone;
use Illuminate\Database\Seeder;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezones = [
            'GMT',
            'Etc/GMT+12',
            'Etc/GMT+11',
            'Pacific/Apia',
            'Pacific/Midway',
            'Pacific/Honolulu',
            'America/Juneau',
            'America/Los_Angeles',
            'America/Denver',
            'America/Chicago',
            'America/New_York',
            'America/Argentina/Buenos_Aires',
            'America/Sao_Paulo',
            'Atlantic/Cape_Verde',
            'Europe/London',
            'Europe/Paris',
            'Europe/Istanbul',
            'Africa/Lagos',
            'Asia/Dubai',
            'Asia/Kolkata',
            'Asia/Dhaka',
            'Asia/Jakarta',
            'Asia/Tokyo',
            'Australia/Sydney',
            'Pacific/Auckland',
        ];

        foreach ($timezones as $timezone) {
            Timezone::create(['timezone' => $timezone]);
        }
    }
}
