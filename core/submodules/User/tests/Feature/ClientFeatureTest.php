<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tests\Support\Test\Concerns\InteractsWithAuthentication;
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
class ClientFeatureTest extends TestCase
{
    use DatabaseMigrations, WithRepository;

    /** setUp */
    public function setUp()
    {
        parent::setUp();

        $provider = factory(User::class)->make();
        $this->user = $this->repository(UserRepository::class, User::class)
                           ->create($provider->toArray());
    }

    /** @provider */
    public function providerUser()
    {
        $this->refreshApplication();

        $provider = factory(User::class)->make();

        return [
            // for testClientCanLogInViaLoginPage
            [$provider->toArray(), [], true],
        ];
    }

    /**
     * @test
     * @group         client
     * @dataProvider  providerUser
     */
    public function testItCanLogInViaLoginPage($user)
    {
        // Save to database first.
        $user = $this->persistProviderToDatabase($user);

        // Log in user via the url
        $this->post(route('login.login', $user->only(['username', 'password'])));
        $this->actingAs($user);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @group         client
     * @dataProvider  providerUser
     */
    public function testLoginWithWrongCredentials($user)
    {
        // Save to database first.
        $user = $this->persistProviderToDatabase($user);

        // Navigate to the login page.
        $this->get(route('login.show'))
            ->assertStatus(200);

        // Login
        $this->post(route('login.login'), $user->only(['username', 'password']))
            ->assertStatus(302);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function persistProviderToDatabase(array $user) : Model
    {
        return $this->repository(UserRepository::class, User::class)
            ->create(array_merge(
                $user, ['password' => Hash::make('secret')]
            ));
    }
}
