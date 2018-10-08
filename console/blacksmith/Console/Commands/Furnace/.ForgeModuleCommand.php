<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class ForgeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:module
                           {name : The module to create}
                           {--m|module=none : Specify the module it belongs to, if applicable}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the directories for the module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $filesystem)
    {
        $name = studly_case($this->argument('name'));
        $slug = strtolower(str_slug($name));
        $option = $this->option();
        $module = modules_path($name);
        $modules = get_modules_path(true);

        // Then its a submodule
        $submodule = $name;
        $module = get_module($option['module']) ? get_module($option['module']) . "/submodules/$submodule" : null;
        if (is_null($module)) {
            $this->info("Module will be $name.");
            $chosen = $this->choice("Options available", ["create '$name' as a top-level module", "make '$name' a submodule of an existing module", 'cancel']);

            switch ($chosen) {
                case "make '$name' a submodule of an existing module":
                    $module = $this->choice("What module to put '$name' in?", array_merge(['core'], $modules));
                    $module = $module === "core" ? core_path("submodules/$name") : get_module($module) . "/submodules/$submodule";
                    break;

                case "create '$name' as a top-level module":
                    $module = modules_path($name);
                    // $module = "$module/submodules/$submodule";
                    break;

                case 'cancel':
                default:
                    exit();
                    break;
            }
        }

        $this->info("Using path: $module");

        // Create the module files
        $directories = [
            "$module/assets",
            "$module/config",
            "$module/Controllers",
            "$module/database/migrations",
            "$module/database/seeds",
            "$module/Models",
            "$module/Observers",
            "$module/Providers",
            "$module/Requests",
            "$module/routes",
            "$module/views",
        ];
        foreach ($directories as $directory) {
            $filesystem->directory($directory, 0755, true, true);
            $this->info("Directory created: $directory");
        }

        $slug = str_plural($slug);
        $files = [
            "$module/config/menus.php",
            "$module/Providers/{$name}ServiceProvider.php",
            "$module/Requests/{$name}Request.php",
            "$module/routes/admin.php",
            "$module/views/$slug/create.blade.php",
            "$module/views/$slug/edit.blade.php",
            "$module/views/$slug/index.blade.php",
            "$module/views/$slug/trash.blade.php",
        ];

        // Controller
        $this->call("forge:controller", ['name' => "$name", '--module' => basename($module)]);

        // Model
        $this->call("forge:model", ['name' => "$name", '--module' => basename($module)]);

        // config/permissions.php
        $this->call("forge:permissions", ['--module' => basename($module)]);

        // Observers
        $this->call("forge:observer", ['name' => "{$name}Observer", '--module' => basename($module)]);

        foreach ($files as $file) {
            switch ($file) {
                case "$module/views/$slug/create.blade.php":
                case "$module/views/$slug/edit.blade.php":
                case "$module/views/$slug/index.blade.php":
                case "$module/views/$slug/trash.blade.php":
                    $template = $filesystem->put(
                        blacksmith_path("templates/views/generic.stub"),
                        []
                    );
                    break;

                case "$module/Requests/{$name}Request.php":
                    $code = str_singular($slug);
                    $name = studly_case($this->argument('name'));
                    $template = $filesystem->put(
                        blacksmith_path("templates/requests/FormRequest.stub"),
                        compact('code', 'name', 'slug')
                    );
                    break;

                case "$module/Providers/{$name}ServiceProvider.php":
                    $name = studly_case($this->argument('name'));
                    $template = $filesystem->put(
                        blacksmith_path("templates/providers/ServiceProvider.stub"),
                        compact('file', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/config/menus.php":
                    $name = studly_case($this->argument('name'));
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/config/menus.stub"),
                        compact('code', 'module', 'name', 'slug')
                    );
                    break;

                case "$module/routes/admin.php":
                case "$module/routes/public.php":
                    $name = studly_case($this->argument('name'));
                    $code = str_singular($slug);
                    $template = $filesystem->put(
                        blacksmith_path("templates/routes/route.stub"),
                        compact('code', 'module', 'name', 'slug')
                    );
                    break;

                default:
                    $template = "<?php ";
                    break;
            }

            if ($filesystem->make($file, $template)) {
                $this->info("File created: $file");
            }
        }

        exec("composer dump-autoload -o");
    }
}
