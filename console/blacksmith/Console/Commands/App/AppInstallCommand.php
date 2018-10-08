<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;
use Pluma\Support\Bootstrap\LoadConfiguration;
use Illuminate\Filesystem\Filesystem;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install
                           {--skip-migration : Skips the database migration step}
                           {--skip-seed : Skips the database seeding step}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Perform the initial setup.";

    /**
     * The progress indicator.
     *
     * @var mixed
     */
    protected $progressbar;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->progressbar = $this->output->createProgressBar(4);

        // Step 0
        $this->welcomeMessage();

        // Step 1
        $credentials = $this->askForCredentialDetails();
        $this->createEnv($credentials);

        // Step 2
        $this->generateAppKey();

        // Step 3
        $this->loadEnv('.env');

        // Step 4
        $this->migrateDatabase();
    }

    /**
     * Display the welcome message.
     *
     * @return void
     */
    protected function welcomeMessage()
    {
        $this->call('app:version');
        $this->line([
            " # Getting Started",
            "   ───────────────",
        ]);
        $this->line("   The application setup will write the .env file, run the migration files, and seed the database.");
        $this->line("   This console utility is intended for assisting in development. It is recommended NOT to run this command in the production server.");
        $this->line("");

        $this->line([
            " # Before We Begin",
            "   ───────────────",
        ]);
        $this->warn("   Please make sure you have a database already created on your server.");
        $this->line("   You will need to provide this along with the database username and password.");
        $this->line("");
        $this->line("   After obtaining the information above, you may proceed with the setup.");

        if (! $this->confirm("Do you want to continue with the application setup now?", 1)) {
            $this->warn("You've cancelled setup");
            exit();
        }
    }

    /**
     * Retrieve user input for the .env
     *
     * @return array
     */
    protected function askForCredentialDetails()
    {
        $this->info("DATABASE");
        $this->loadEnv(
            file_exists(base_path('.env')) ? '.env' : '.env.example'
        );

        return [
            'DB_CONNECTION' => $this->ask("Database connection", getenv('DB_CONNECTION')),
            'DB_HOST' => $this->ask("Database host", getenv('DB_HOST')),
            'DB_PORT' => $this->ask("Database port", getenv('DB_PORT')),
            'DB_DATABASE' => $this->ask("Database name", getenv('DB_DATABASE')),
            'DB_USERNAME' => $this->ask("Database username", getenv('DB_USERNAME')),
            'DB_PASSWORD' => $this->ask("Database password (visible)", getenv('DB_PASSWORD')),

            'APP_NAME' => $this->ask("App name", getenv('APP_NAME')),
            'APP_TAGLINE' => $this->ask("App tagline", getenv('APP_TAGLINE')),
            'APP_AUTHOR' => $this->ask("App author", getenv('APP_AUTHOR')),
            'APP_YEAR' => $this->ask("App year", getenv('APP_YEAR')),
            'APP_ENV' => $this->ask("App env", getenv('APP_ENV')),
            'APP_TIMEZONE' => $this->ask("App timezone", getenv('APP_TIMEZONE')),
            'APP_DEBUG' => $this->ask("App debug", getenv('APP_DEBUG')),
        ];
    }

    /**
     * Get the default env from .env.example
     *
     * @param  string $file
     * @return void
     */
    protected function loadEnv($file = '.env')
    {
        with(new \Dotenv\Dotenv(base_path(), $file))->overload();
        with(new LoadConfiguration())->bootstrap(app());
    }

    /**
     * Create a .env file
     *
     * @param  array $credentials
     * @return void
     */
    protected function createEnv($credentials)
    {
        $copypath = base_path('.env.example');
        $filepath = $this->webApp->environmentFilePath();

        if (! $this->files->exists($filepath)) {
            $this->files->copy($copypath, $filepath);
        }

        write_to_env($credentials, $filepath);
    }

    /**
     * Generate a random APP_KEY
     *
     * @return void
     */
    protected function generateAppKey()
    {
        $this->info("APPLICATION KEY");
        $this->call('key:generate');
        $this->line('');
    }

    /**
     * Perform a database migration.
     *
     * @return void
     */
    protected function migrateDatabase()
    {
        $this->info("DATABASE MIGRATION AND SEED");
        if (! $this->option('skip-migration')) {
            if (! $this->option('skip-seed')) {
                $this->info("Migrating database (will seed afterwards)...");
                $this->call('db:migrate', ['--seed' => true]);
            } else {
                $this->info("Migrating database (skipped seeding)...");
                $this->call('migration:migrate');
            }
        }
    }
}
