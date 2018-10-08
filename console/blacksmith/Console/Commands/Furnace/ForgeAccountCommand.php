<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Role\Models\Role;
use User\Models\User;

class ForgeAccountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:account
                           {--r|random : Generate random account}
                           {--p|pretend : Will not save to database}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user account. Should only be used during development as the password generator is weak.';

    /**
     * User instance.
     *
     * @var \User\Models\User
     */
    protected $user;

    /**
     * Password for random user.
     *
     * @var string
     */
    protected $password;

    /**
     * Role instance.
     *
     * @var \Role\Models\Role
     */
    protected $role;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->displayLogo();

        $role = $this->getSelectedRole();

        if ($this->option('random')) {
            $this->makeRandomUser($role);
        } else {
            $this->makeUser($role);
        }

        $this->displayTable();
    }

    /**
     * Retrieve the selected role.
     *
     * @return \Role\Models\Role
     */
    protected function getSelectedRole()
    {
        $this->role = $this->choice("Specify which role the user will have", Role::pluck('name', 'code')->toArray());
        $this->role = Role::whereCode($this->role)->first();

        return $this->role;
    }

    /**
     * Display fancy logo.
     *
     * @return void
     */
    protected function displayLogo()
    {
        $this->call('app:version');
        $this->info("Generate User");
    }

    /**
     * Display fancy table.
     *
     * @return void
     */
    protected function displayTable()
    {
        $this->table(
            ['Full Name', 'Email', 'Username', 'Password', 'Role'],
            [array_merge(
                $this->user->only(['fullname', 'email', 'username']),
                [
                    'password' => $this->password,
                    'role' => $this->role->name,
                ]
            )]
        );
    }

    /**
     * Get the user input to generate a user.
     *
     * @param \Role\Models\Role $role
     * @return void
     */
    protected function makeUser(Role $role)
    {
        $firstname = $this->ask("First name");
        $lastname = $this->ask("Last name");
        $email = $this->ask("Email");
        $username = $this->ask("User name", $email);
        $password = $this->secret("Password (hidden)");
        $this->password = $password;

        $password = Hash::make($password);
        $user = compact('firstname', 'lastname', 'email', 'username', 'password');

        $this->user = $this->generateAccount($user, $role);
    }

    /**
     * Generate the user.
     *
     * @param string $role
     * @return void
     */
    protected function makeRandomUser($role)
    {
        // Generate random password.
        $this->password = $this->getRandomPassword();

        // Generate the user.
        $params = [
            'password' => Hash::make($this->password),
            'api_token' => Hash::make($this->getRandomPassword()),
        ];

        $this->user = $this->generateAccount($params, $role);
    }

    /**
     * Randomly generate the account
     *
     * @param  array $params
     * @param  Role  $role
     * @return  \Illuminate\Database\Eloquent\Model
     */
    protected function generateAccount(array $params = [], Role $role = null) : Model
    {
        $model = config('auth.providers.users.model', \User\Models\User::class);
        if ($this->option('pretend')) {
            $user = factory($model)->make($params);
        } else {
            $user = factory($model)->create($params);
            $user->roles()->save($role);
        }

        $this->info('Completed generating account.');

        return $user;
    }

    /**
     * Generate random password
     *
     * @param int|integer $length
     * @return string
     */
    protected function getRandomPassword(int $length = 10) : String
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
