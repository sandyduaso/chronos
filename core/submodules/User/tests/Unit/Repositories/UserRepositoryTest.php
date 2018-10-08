<?php

namespace Tests\Unit\Repositories;

use Role\Models\Role;
use Tests\Support\Test\DatabaseMigrations;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group user:repository
     */
    public function testModelMethodReturnsAUserModelInstance()
    {
        $repository = new UserRepository();
        $expected = User::class;
        $actual = $repository->model();

        $this->assertInstanceOf($expected, $actual);
    }

    /**
     * @test
     * @group user:repository
     */
    public function testRepositoryCanCreateUser()
    {
        factory(Role::class)->states('admin', 'superadmin')->create();
        $user = factory(User::class)->make([
            'details' => [
                'birthday' => '2018/09/22',
                'gender' => 'Male',
            ],
            'roles' => [1],
        ]);

        $repository = new UserRepository();
        $repository->create($user->toArray());

        $expected = 1;
        $actual = $repository->model()->count();
        $this->assertEquals($expected, $actual);

        $expected = 1;
        $actual = $repository->find(1)->roles->count();
        $this->assertEquals($expected, $actual);

        $expected = 2;
        $actual = $repository->find(1)->details->count();
        $this->assertEquals($expected, $actual);
    }
}
