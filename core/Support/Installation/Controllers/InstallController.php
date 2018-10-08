<?php

namespace Pluma\Support\Installation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Pluma\Support\Auth\Traits\CreateUser;
use Pluma\Support\Database\Traits\CreateDatabase;
use Pluma\Support\Database\Traits\MigrateDatabase;
use Pluma\Support\Database\Traits\SeedDatabase;
use Pluma\Support\Installation\Requests\SetupRequest;
use Pluma\Support\Installation\Requests\UserRequest;
use Role\Models\Grant;
use Role\Models\Role;
use User\Models\User;

class InstallController extends Controller
{
    use CreateDatabase, MigrateDatabase, CreateUser, SeedDatabase;

    /**
     * Checks if already migrated.
     *
     * @var boolean
     */
    protected $migrated = false;

    /**
     * Display the welcome page.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Install::welcome.index");
    }

    /**
     * Display the setup page.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSetupForm(Request $request)
    {
        if ($this->isMigrated()) {
            return redirect()->route('installation.seed.form');
        }

        return view("Install::welcome.setup");
    }

    /**
     * Store the setup parameters.
     *
     * @param  \Pluma\Support\Installation\Requests\SetupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function setup(SetupRequest $request)
    {
        try {
            if (! file_exists(base_path('.env'))) {
                write_to_env($request->all());
                write_to_env(['APP_KEY' => generate_random_key()]);
            }

            $this->db(
                $request->input('DB_DATABASE'),
                $request->input('DB_USERNAME'),
                $request->input('DB_PASSWORD')
            )->drop()->make();

            if ($this->migrate()) {
                $this->setMigrated(true);
            }

        } catch (Whoops\Exception\ErrorException $e) {
            return view("Install::errors.general")->with(compact('e'));
        } catch (\Exception $e) {
            return view("Install::errors.general")->with(compact('e'));
        }

        return redirect()->route('installation.seed.form');
    }

    /**
     * Display the seed page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSeedForm(Request $request)
    {
        if (! $this->isMigrated()) {
            return redirect()->route('installation.setup');
        }

        return view("Install::welcome.seed");
    }

    /**
     * Performs the seeding.
     *
     * @param  \Pluma\Support\Installation\Requests\UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request)
    {
        try {
            // Seed tables.
            $this->seed();

            $user = new User();
            $user->email = $request->input('email');
            $user->username = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $role = Role::whereCode('superadmin')->first();
            $role->grants()->attach((Grant::pluck('id')));
            $user->save();
            $user->roles()->attach($role);

        } catch (Whoops\Exception\ErrorException $e) {
            return view("Install::errors.general")->with(compact('e'));
        } catch (\Exception $e) {
            return view("Install::errors.general")->with(compact('e'));
        }

        return redirect()->route('installation.last');
    }

    public function last(Request $request)
    {
        if (! $this->isMigrated()) {
            return redirect()->route('installation.setup.form');
        }

        $user = User::get()->first();

        return view("Install::welcome.last")->with(['user' => $user, 'config' => config('env')]);
    }

    /**
     * Remove the install files.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function clean(Request $request)
    {
        try {
            File::delete(base_path('bootstrap/cache/services.php'));
            File::delete(storage_path('.migrated'));
            File::delete(storage_path('.install'));
            File::put(storage_path('.installed'), "installed=true\nIgnore me.");
            // File::delete(storage_path('.installed'));
        } catch (\Exception $e) {

        } finally {
            session()->flash('title', __('Success'));
            session()->flash('type', 'success');
            session()->flash('message', __('Files successfully removed.'));
        }

        $user = User::get()->first();

        return view("Install::welcome.last")->with(['user' => $user, 'config' => config('env')]);
    }

    /**
     * Sets the migrated variable.
     *
     * @param bool $migrated
     */
    protected function setMigrated($migrated)
    {
        $this->migrated = $migrated;
        File::put(storage_path('.migrated'), 'true');
    }

    /**
     * Checks if the .migrate file exists.
     *
     * @return boolean
     */
    protected function isMigrated()
    {
        return File::exists(storage_path('.migrated'));
    }
}
