<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgeControllerCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:controller
                           {name : The controller to create}
                           {--m|module= : Specify the module it belongs to, if applicable.}
                           {--a|admin : Specify the controller extends the Admin Controller.}
                           {--p|public : Specify the controller extends the Public Controller.}
                           {--g|general : Specify the controller extends the General purpose Controller.}
                           {--api : Specify the controller extends the Api Controller.}
                           {--model : Generate a resource controller for the given model.}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a generic controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

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
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->qualifyModule();

        parent::handle();

        $this->composer->dumpAutoloads();
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
            $module = $this->choice("Specify the module the seeder will belong to.", $this->modules());
        }

        $this->module = $this->getModulePath($module);

        $this->input->setOption('module', $this->module);

        return $this->module;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = 'templates/controllers/Controller.stub';

        if ($this->option('admin')) {
            $stub = 'templates/controllers/AdminController.stub';
        } elseif ($this->option('public')) {
            $stub = 'templates/controllers/PublicController.stub';
        } elseif ($this->option('general')) {
            $stub = 'templates/controllers/GeneralController.stub';
        } elseif ($this->option('api')) {
            $stub = 'templates/controllers/ApiController.stub';
        }

        return blacksmith_path($stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('forge:model', [
                    'name' => $modelClass,
                    '--module' => $this->module,
                ]);
            }
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new \InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\Models', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->rootNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model.'\\Models\\'.$model;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return basename($this->module);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = basename($name);

        return module_path($this->rootNamespace()).'Controllers/'.$name.'.php';
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return $this->rootNamespace().'\Controllers';
    }
}
