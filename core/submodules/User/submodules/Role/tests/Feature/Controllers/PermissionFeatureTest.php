<?php

namespace Tests\Feature\Controllers;

use Role\Models\Role;
use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\RefreshDatabase;
use Tests\TestCase;
use User\Models\User;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PermissionFeatureTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test
     * @group feature:permission
     */
    public function testUserCanViewTheAllPermissionsPage()
    {
        $role = factory(Role::class)->states('superadmin')->create();
        $user = factory(User::class)->create();
        $user = User::first();
        $user->roles()->save($role);
        $user->update();

        $this
            ->be($user)
            ->assertAuthenticatedAs($user);

        $this->get(route('permissions.index'))
            // Status
            ->assertStatus(200);
            // See Table of permissions
            // ->assertSee(__('Name'))
            // ->assertSee(__('Code'))
            // ->assertSee(__('Description'))
            // // See Permissions title
            // ->assertSee(__('Permissions'));
    }
}
