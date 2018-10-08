<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Pluma\Support\Modules\Traits\ModulerTrait;
use Symfony\Component\Console\Input\InputOption;

class ForgeResourceCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'forge:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Resource';

    /**
     * The module of the resource belongs to.
     *
     * @var string
     */
    protected $module;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->qualifyModule();

        if ($this->collection()) {
            $this->type = 'Resource collection';
        }

        parent::handle();
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
        return $this->collection()
                    ? blacksmith_path('templates/resources/resource-collection.stub')
                    : blacksmith_path('templates/resources/resource.stub');
    }

    /**
     * Determine if the command is generating a resource collection.
     *
     * @return bool
     */
    protected function collection()
    {
        return $this->option('collection') ||
               Str::endsWith($this->argument('name'), 'Collection');
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
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Resources';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = $this->argument('name');
        $path = $this->module;
        return $path.'/Resources/'.$name.'.php';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', 'm', InputOption::VALUE_NONE, 'The module the resource belongs to.'],
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection.'],
        ];
    }
}
