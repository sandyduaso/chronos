<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgeModuleCommand extends Command
{
    use ModulerTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:module
                           {name : The name of the module}
                           {--m|module= : The module the submodule belongs to}
                           {--c|core : Specify the module should be core}
                           {--standalone : Specify the module should be top level}
                           {--empty : Generate folders only}
                           ';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * The module the generated file belongs to.
     *
     * @var string
     */
    protected $module;

    /**
     * Array of module levels.
     *
     * @var array
     */
    protected $moduleLevels = [
        'core' => 'Core',
        'module' => 'Save in the modules folder',
        'submodule' => 'Save as a submodule of another module'
    ];

    /**
     * The selected module level.
     *
     * @var string
     */
    protected $level;

    /**
     * The path the folders and files will be created.
     *
     * @var string
     */
    protected $path;

    /**
     * The filesystem instance.
     *
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->files = $files;

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->qualifyModuleLevel();

        if ($this->isSubmoduleLevel()) {
            $this->qualifyModule();
        }

        $this->qualifyPath();

        $this->generateFolders();

        if (! $this->option('empty')) {
            $this->generateConfig();
            $this->generateController();
            // $this->generateDatabase();
        }

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the level of the module.
     *
     * @return void
     */
    protected function qualifyModuleLevel()
    {
        if ($this->option('standalone')) {
            $this->level = 'standalone';
        } elseif ($this->option('core')) {
            $this->level = 'core';
        } else {
            $name = $this->argument('name');
            $this->level = $this->choice("What type of module do you want create with $name?", $this->moduleLevels);
        }
    }

    /**
     * Get the module the file belongs to.
     *
     * @return string
     */
    protected function qualifyModule()
    {
        $module = $this->input->getOption('module');

        if (! $module || ! $this->isModule($module)) {
            $module = $this->choice("Specify the module the submodule will belong to.", $this->modules());
        }

        $this->module = $this->getModulePath($module);

        $this->input->setOption('module', $this->module);

        return $this->module;
    }

    /**
     * Get the path of the module.
     *
     * @return void
     */
    protected function qualifyPath()
    {
        switch ($this->level) {
            case 'core':
                $path = core_path('submodules');
                break;

            case 'submodule':
                $path = $this->module.DIRECTORY_SEPARATOR.'submodules';
                break;

            case 'module':
            default:
                $path = modules_path();
                break;
        }

        $this->path = $path.DIRECTORY_SEPARATOR.$this->argument('name');

        $this->info("Using path: {$this->path}");
    }

    /**
     * Check if level is equal to submodule.
     *
     * @return boolean
     */
    protected function isSubmoduleLevel(): bool
    {
        return $this->level === 'submodule';
    }

    /**
     * Create module folder.
     *
     * @return void
     */
    protected function generateFolders()
    {
        $module = $this->path;

        $directories = [
            "$module/config",
            "$module/Controllers",
            "$module/Controllers/Resources",
            "$module/database/factories",
            "$module/database/migrations",
            "$module/database/seeds",
            "$module/Models",
            "$module/Observers",
            "$module/Providers",
            "$module/Repositories",
            "$module/Requests",
            "$module/Resources",
            "$module/routes",
            "$module/views",
        ];

        foreach ($directories as $directory) {
            $this->files->makeDirectory($directory, 0755, true, true);
            $this->info("Directory created: $directory");
        }
    }

    /**
     * Create common config files.
     *
     * @return void
     */
    protected function generateConfig()
    {
        $name = $this->argument('name');
        $module = basename($this->path);

        $commands = [
            'forge:permissions' => [
                '--module' => $module,
            ],
            'forge:menus' => [
                '--module' => $module,
            ],
        ];

        foreach ($commands as $command => $options) {
            $this->call($command, $options);
        }
    }

    /**
     * Create controller file.
     *
     * @return void
     */
    protected function generateController()
    {
        $name = $this->argument('name').'Controller';

        $this->call('forge:controller', [
            'name' => $name,
            '--general' => true,
            '--module' => $this->argument('name'),
        ]);
    }
}
