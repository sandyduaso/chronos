<?php

use Role\Models\Permission;
use Pluma\Support\Database\Seeder;
use Pluma\Support\Modules\Traits\ModulerTrait;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::seeds() as $permission) {
            Permission::updateOrCreate(
                ['code' => $permission['code']],
                $permission
            );
        }
    }
}
