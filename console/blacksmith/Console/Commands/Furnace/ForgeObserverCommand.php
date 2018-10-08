<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgeObserverCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:observer
                           {name=null : The model to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a generic observer';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            $name = studly_case($this->argument('name'));
            $slug = strtolower(str_slug($name));
            $option = $this->option();
            $module = get_module($option['module']);
            $modules = get_modules_path(true);

            if ($this->argument('name') === 'null' || is_null($name)) {
                $name = $this->ask("Please specify the model name: (e.g. QuestObserver)");
            }

            if ($option['module'] === 'none' || is_null($module)) {
                $module = get_module($option['module']);

                if (is_null($module)) {
                    $this->error("Please specify the module this model belongs to.");
                    $module = $this->choice("What module to put '$name' in?", $modules);
                    $module = get_module($module);
                }

                $this->info("Using path: $module");
            }

            $file = "$module/Observers/{$name}.php";

            $namespace = basename($module);
            $name = $name;
            $namespace = basename($module);
            $class = $name;
            $model = basename($module);
            $slug = strtolower(str_plural($name));
            $template = $filesystem->put(
                blacksmith_path("templates/observers/Observer.stub"),
                compact('namespace', 'name', 'class', 'model', 'slug')
            );

            if ($filesystem->make($file, $template)) {
                $this->info("File created: $file");
            }

            $this->warn("Don't forget to register this Observer to a Service Provider.");

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
