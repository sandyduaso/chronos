<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgeTestCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'forge:test
                           {name : The name of the class}
                           {--m|module : The module the test belongs to}
                           {--u|unit : Create a unit test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        // Module
        $module = $this->option('module');

        if ($module || ! $this->isModule($module)) {
            $module = $this->choice("Specify the module the test belongs to.", $this->modules());
        }

        $module = $this->getModulePath($module);

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name, $module);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('unit')) {
            return blacksmith_path('templates/tests/unit-test.stub');
        }

        return blacksmith_path('templates/tests/test.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name, $module = null)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $basePath = $module ?? base_path();

        return "{$basePath}/tests".str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('unit')) {
            return $rootNamespace.'\Unit';
        } else {
            return $rootNamespace.'\Feature';
        }
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Tests';
    }
}
