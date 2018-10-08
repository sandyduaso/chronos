<?php

namespace Tests\Unit\Repositories;

use Pluma\Support\Repository\Repository;
use Role\Models\Permission;
use Role\Repositories\PermissionRepository;
use Tests\Support\Test\DatabaseMigrations;
use Tests\TestCase;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PermissionRepositoryUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group unit:permission
     */
    public function testRepositoryCanInitialize()
    {
        $repository = new PermissionRepository();

        $this->assertInstanceOf(Repository::class, $repository);
    }

    /**
     * @test
     * @group unit:permission
     */
    public function testRepositoryCanRetrieveRulesViaRulesMethod()
    {
        $this->assertInternalType('array', PermissionRepository::rules());
    }

    /**
     * @test
     * @group unit:permission
     */
    public function testRepositoryCanRetrieveRulesMessagesViaMessagesMethod()
    {
        $this->assertInternalType('array', PermissionRepository::messages());
    }

    /**
     * @test
     * @group unit:permission
     */
    public function testRepositoryCanRetrieveAllPermissions()
    {
        $seeder = new \PermissionsTableSeeder();
        $seeder->run();

        $repository = new PermissionRepository();
        $expected = Permission::all();
        $actual = $repository->all();

        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected->first()->name, $actual->first()->name);
    }

    /**
     * @test
     * @group unit:permission
     */
    public function testRepositoryCanRetrieveSeeds()
    {
        $seeder = new \PermissionsTableSeeder();
        $seeder->run();

        $repository = new PermissionRepository();
        $expected = Permission::seeds();
        $actual = $repository->seeds();

        $this->assertEquals($expected, $actual);
        $this->assertEquals(collect($expected)->first(), collect($actual)->first());
    }
}
