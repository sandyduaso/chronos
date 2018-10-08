<?php

namespace Blacksmith\Console\Commands\Refresh;

use Blacksmith\Support\Console\Command;
use Role\Models\Role;

class RefreshRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate application roles.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('refresh:permissions');

        $roles = array_merge(
            [
                array(
                    'name' => 'Super Administrator',
                    'alias' => 'Superadmin',
                    'code' => 'superadmin',
                    'description' => 'The highest role available for users.',
                ),
                array(
                    'name' => 'Administrator',
                    'alias' => 'Admin',
                    'code' => 'admin',
                    'description' => 'The official site admin which manages creation of other users.',
                )
            ],
            config('defaults.roles', [])
        );

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
