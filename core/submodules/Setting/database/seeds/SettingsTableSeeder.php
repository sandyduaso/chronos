<?php

use Setting\Models\Setting;
use Pluma\Support\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Site
            'site_title' => config('APP_NAME', env('APP_NAME')),
            'site_tagline' => config('APP_NAME', env('APP_TAGLINE')),
            'site_email' => config('APP_NAME', env('MAIL_USERNAME')),
            'date_format' => 'F d, Y',
            'time_format' => 'h:i a',

            // Admin
            'active_theme' => 'default',

            // Mail
            'mail_driver' => config('mail.driver'),
            'mail_host' => config('mail.host'),
            'mail_port' => config('mail.port'),
            'mail_encryption' => config('mail.encryption'),
            'mail_username' => config('mail.username'),
            'mail_password' => config('mail.password'),
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? serialize($value) : $value]);
        }
    }
}
