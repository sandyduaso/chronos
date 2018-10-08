<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:permissions
                           {name=permissions : The model to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the permissions file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            $filename = strtolower($this->argument('name'));
            $name = studly_case($this->argument('name'));
            $slug = strtolower(str_slug($name));
            $option = $this->options();
            $module = get_module($option['module']);
            $modules = get_modules_path(true);

            $this->info("Creating file: $filename.php");

            if ($module && ! $this->isModule($module)) {
                $module = get_module($option['module']);

                if (is_null($module)) {
                    $this->error("Please specify the module this model belongs to.");
                    $module = $this->choice("What module to put '$filename.php' in?", $modules);
                    $module = get_module($module);
                }

                $this->info("Using path: $module");
            }

            $files = [
                "$module/config/{$filename}.php",
            ];

            foreach ($files as $file) {
                $slug = strtolower(str_plural(basename($module)));
                $name = studly_case(basename($module));
                $code = str_singular($slug);
                $template = $filesystem->put(
                    blacksmith_path("templates/config/permissions.stub"),
                    compact('code', 'module', 'name', 'slug')
                );

                if ($filesystem->make($file, $template)) {
                    $this->info("File created: $file");
                }
            }

            exec("composer dump-autoload -o");
        } catch (\Pluma\Support\Filesystem\FileAlreadyExists $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        } catch (\Exception $e) {
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
            $this->error(" ".$e->getMessage()." ");
            $this->error(" ".str_pad(' ', strlen($e->getMessage()))." ");
        }
    }
}
