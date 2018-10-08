<?php

use Pluma\Support\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use User\Models\User;
use Role\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);

        $users = [
            [
                'firstname' => 'Pluma',
                'lastname' => 'CMS',
                'username' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'email' => 'dummy@pluma.io',
                'roles' => ['superadmin'],
            ],
        ];

        foreach ($users as $fake) {
            $user = User::updateOrCreate([
                'username' => $fake['username'],
                'email' => $fake['email'],
            ], collect($fake)->except('roles')->all());

            $user->roles()->sync(Role::whereIn('code', $fake['roles'])->pluck('id'));
        }
    }
}
