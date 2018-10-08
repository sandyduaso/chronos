<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Pluma\Support\Filesystem\Filesystem;
use Pluma\Support\Modules\Traits\ModulerTrait;

class ForgePermissionsCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:permissions
                           {name=permissions : The permission file name}
                           {--m|module= : Specify the module the permission file belongs to}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permissions file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Permission';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->qualifyModule();

        parent::handle();
    }

    /**
     * Get the module the file belongs to.
     *
     * @return string
     */
    protected function qualifyModule()
    {
        $module = $this->option('module');

        if (! $this->isModule($module)) {
            $module = $this->choice("Specify the module the permission file will belong to.", $this->modules());
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
        return blacksmith_path("templates/config/permissions.stub");
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $module = $this->module;
        $name = $this->argument('name');

        return $module.'/config/'.$name.'.php';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceSlug($stub, $name)->replaceCode($stub, $name);
    }

    /**
     * Replace the slug for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceSlug(&$stub, $name)
    {
        $slug = str_plural(strtolower(basename($this->module)));

        $stub = str_replace(['$slug'], [$slug], $stub);

        return $this;
    }

    /**
     * Replace the code for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceCode(&$stub, $name)
    {
        $code = str_singular(strtolower(basename($this->module)));

        $stub = str_replace(['$code'], [$code], $stub);

        return $stub;
    }
}
