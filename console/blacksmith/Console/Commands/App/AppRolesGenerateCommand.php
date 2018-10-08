<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;
use Role\Models\Role;

class AppRolesGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:roles:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate app roles.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roles = array_merge(array(
            array(
                'name' => 'Super Administrator',
                'alias' => 'Superadmin',
                'code' => 'superadmin',
                'description' => 'The highest role available for users. It is recommended app must have atleast one user under this role.',
            ),
            array(
                'name' => 'Administrator',
                'alias' => 'Admin',
                'code' => 'admin',
                'description' => 'The official site role. Manages creation of other users, and everything related to the site.',
            ),
        ), config('defaults.roles', []));

        foreach ($roles as $role) {
            $data = Role::updateOrCreate(['code' => $role['code']]);
            $data->name = $role['name'];
            $data->alias = $role['alias'];
            $data->code = $role['code'];
            $data->description = $role['description'];
            $data->save();
        }

        $this->info("Done.");
    }
}
