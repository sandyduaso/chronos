<?php

namespace Tests\Unit;

use Role\Models\Role;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class UserUnitTest extends TestCase
{
    use DatabaseMigrations,
        WithRepository;

    /**
     * @test
     * @group unit:user
     */
    public function testItCanCreateAUser()
    {
        // Setup
        factory(Role::class)->states('superadmin')->create();

        $repository = $this->repository(UserRepository::class, User::class);

        // Mock data from UserFactory
        $provider = factory(User::class)->make()->toArray();
        $provider['details'] = [
            ['icon' => 'fe fe-star', 'key' => 'Favorite Food', 'value' => 'Estufado'],
        ];
        $provider['roles'] = [1];
        // // Create the user.
        $user = $repository->create($provider);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($provider['email'], $user->email);
        $this->assertEquals($provider['details'][0]['value'], $user->detail('Favorite Food'));
        $this->assertEquals(Role::first()->code, $user->roles->first()->code);
    }
}
