<?php

namespace Blacksmith\Console\Commands\Standalone;

use Blacksmith\Support\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs the app installations.';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            // Name
            ->setName($this->signature)
            ->setDescription($this->description)

            // Arguments
        ;
    }

    /**
     * Execute the console command.
     *
     * @param  Symfony\Component\Console\Input\InputInterface  $input
     * @param  Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<comment>Initializing console...</comment>');

        sleep(1);
        $output->writeln('<comment>Starting installation...</comment>');


        $output->writeln('<comment>Checking environment file...</comment>');
        sleep(1);
        $this->checkEnvironmentFile();
        $this->loadEnvironmentFile();
        $output->writeln('<comment>Environment checked.</comment>');

        sleep(1);
        if ($output->ask('Configure database?', 'yes') == 'yes') {
            $env['DB']['DB_CONNECTION'] = $output->ask('Database connection', $this->env('DB_CONNECTION'));
            $env['DB']['DB_HOST'] = $output->ask('Database host', $this->env('DB_HOST'));
            $env['DB']['DB_PORT'] = $output->ask('Database port', $this->env('DB_PORT'));
            $env['DB']['DB_DATABASE'] = $output->ask('Database database', $this->env('DB_DATABASE'));
            $env['DB']['DB_USERNAME'] = $output->ask('Database username', $this->env('DB_USERNAME'));
            $env['DB']['DB_PASSWORD'] = $output->askHidden('Database password');

            $output->writeln([
                "<comment>Database Configuration</comment>",
                "<comment>Connection</comment>: {$env['DB']['DB_CONNECTION']}",
                "<comment>Host</comment>: {$env['DB']['DB_HOST']}",
                "<comment>Port</comment>: {$env['DB']['DB_PORT']}",
                "<comment>Database</comment>: {$env['DB']['DB_DATABASE']}",
                "<comment>Username</comment>: {$env['DB']['DB_USERNAME']}",
                "<comment>Password</comment>: " . str_repeat("*", strlen($env['DB']['DB_PASSWORD'])),
            ]);

            if ($output->ask('Commit to env?', 'yes') == 'yes') {
                if (blacksmith_write_to_env($env['DB'])) {
                    $output->writeln('<comment>Done.</comment>');
                }
            } else {
                $output->writeln('<comment>Skipped.</comment>');
            }
        } else {
            $output->writeln('<comment>Skipped database configuration.</comment>');
        }

        sleep(1);
        if ($output->ask('Configure mail?', 'yes') == 'yes') {
            $env['MAIL']['MAIL_DRIVER'] = $output->ask('Mail driver', $this->env('MAIL_DRIVER'));
            $env['MAIL']['MAIL_HOST'] = $output->ask('Mail host', $this->env('MAIL_HOST'));
            $env['MAIL']['MAIL_PORT'] = $output->ask('Mail port', $this->env('MAIL_PORT'));
            $env['MAIL']['MAIL_USERNAME'] = $output->ask('Mail username', $this->env('MAIL_USERNAME'));
            $env['MAIL']['MAIL_PASSWORD'] = $output->askHidden('Mail password');
            $env['MAIL']['MAIL_ENCRYPTION'] = $output->ask('Mail encryption', $this->env('MAIL_ENCRYPTION'));

            $output->writeln([
                "<comment>Mail Configuration</comment>",
                "<comment>Driver</comment>: {$env['MAIL']['MAIL_DRIVER']}",
                "<comment>Host</comment>: {$env['MAIL']['MAIL_HOST']}",
                "<comment>Port</comment>: {$env['MAIL']['MAIL_PORT']}",
                "<comment>Username</comment>: {$env['MAIL']['MAIL_USERNAME']}",
                "<comment>Password</comment>: " . str_repeat("*", strlen($env['MAIL']['MAIL_PASSWORD'])),
                "<comment>Encryption</comment>: {$env['MAIL']['MAIL_ENCRYPTION']}",
            ]);

            if ($output->ask('Commit to env?', 'yes') == 'yes') {
                if (blacksmith_write_to_env($env['MAIL'])) {
                    $output->writeln('<comment>Done.</comment>');
                }
            } else {
                $output->writeln('<comment>Skipped.</comment>');
            }
        } else {
            $output->writeln('<comment>Skipped mail configuration.</comment>');
        }

        sleep(1);
        if ($output->ask('Configure app?', 'yes') == 'yes') {
            $env['APP']['APP_NAME'] = $output->ask('App name', $this->env('APP_NAME'));
            $env['APP']['APP_TAGLINE'] = $output->ask('App tagline', $this->env('APP_TAGLINE'));
            $env['APP']['APP_AUTHOR'] = $output->ask('App author', $this->env('APP_AUTHOR'));
            $env['APP']['APP_YEAR'] = $output->ask('App year', date('Y'));
            $env['APP']['APP_ENV'] = $output->ask('App env', $this->env('APP_ENV'));
            $env['APP']['APP_TIMEZONE'] = $output->ask('App timezone', $this->env('APP_TIMEZONE'));
            $env['APP']['APP_DEBUG'] = $output->ask('App debug', $this->env('APP_DEBUG'));

            $output->writeln([
                "<comment>App Configuration</comment>",
                "<comment>Name</comment>: {$env['APP']['APP_NAME']}",
                "<comment>Tagline</comment>: {$env['APP']['APP_TAGLINE']}",
                "<comment>Author</comment>: {$env['APP']['APP_AUTHOR']}",
                "<comment>Year</comment>: {$env['APP']['APP_YEAR']}",
                "<comment>Env</comment>: {$env['APP']['APP_ENV']}",
                "<comment>Timezone</comment>: {$env['APP']['APP_TIMEZONE']}",
                "<comment>Debug</comment>: {$env['APP']['APP_DEBUG']}",
            ]);

            if ($output->ask('Commit to env?', 'yes') == 'yes') {
                if (blacksmith_write_to_env($env['APP'])) {
                    $output->writeln('<comment>Done.</comment>');
                }
            } else {
                $output->writeln('<comment>Skipped.</comment>');
            }
        } else {
            $output->writeln('<comment>Skipped app configuration.</comment>');
        }

        sleep(1);
        $output->writeln([
            "",
            '<comment>You are halfway through...</comment>',
            "",
        ]);

        $this->runCommandsFromAppConsole($output);
    }

    /**
     * Load the env to global.
     *
     * @return void
     */
    protected function loadEnvironmentFile()
    {
        if (file_exists(blacksmith_base_path('.env'))) {
            (new \Dotenv\Dotenv(blacksmith_base_path()))->overload();
        }
    }

    /**
     * Check if .env file exists, copy if not.
     *
     * @return void
     */
    protected function checkEnvironmentFile()
    {
        if (! file_exists(blacksmith_base_path('.env'))) {
            copy(blacksmith_base_path('.env.example'), blacksmith_base_path('.env'));
        }
    }

    /**
     * Get value of specified env key.
     *
     * @return string
     */
    protected function env($key)
    {
        return getenv($key);
    }

    /**
     * Run commands from the app console.
     *
     * @param  Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function runCommandsFromAppConsole($output)
    {
        sleep(1);
        $output->writeln("<comment>Initializing the application...</comment>");
        $this->loadEnvironmentFile();
        sleep(1);

        $app = require blacksmith_path('bootstrap/app.php');

        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["app:version"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );

        sleep(1);
        $output->writeln("<comment>Generating application key...</comment>");
        sleep(1);

        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["key:generate"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );

        sleep(1);
        $output->writeln("<comment>Migrating the database...</comment>");
        sleep(1);

        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["db:migrate"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );

        sleep(1);
        $output->writeln("<comment>Seeding the tables...</comment>");
        sleep(1);

        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["db:seed"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );

        sleep(1);
        $output->writeln("<comment>Creating an account...</comment>");
        sleep(1);
        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["forge:account"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );

        // Exit
        $output->writeln("<comment>All Done ;).</comment>");
        sleep(1);

        $status = $kernel->handle(
            $input = new \Symfony\Component\Console\Input\ArrayInput(
                ["app:homepage"]
            ),
            new \Symfony\Component\Console\Output\ConsoleOutput
        );


        $kernel->terminate($input, $status);
        exit($status);
    }
}
