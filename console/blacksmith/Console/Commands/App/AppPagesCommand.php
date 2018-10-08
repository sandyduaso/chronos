<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppPagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Display the list of the app's default pages.";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $headers = ['URLs', 'URI'];

        $body = [
            ["Base URL", url('/')],
            ["Home Page", url(settings('site_home', '/'))],
            ["Login Page", route('login.show')],
            ["Register Page", route('register.show')],
            ["Admin Page", url(settings('admin_slug', 'admin'))],
            ["Dashboard Page", route('dashboard')],
        ];

        $this->table($headers, $body);
    }
}
