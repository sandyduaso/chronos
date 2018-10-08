<?php

use Role\Models\Role;
use Pluma\Support\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataset = array(
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
            ),
        );

        $dataset = array_merge($dataset, config('auth.roles', []));

        foreach ($dataset as $set) {
            Role::updateOrCreate(['code' => $set['code']], $set);
        }
    }
}
