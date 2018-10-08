<?php

namespace Blacksmith\Console\Commands\Furnace;

use Blacksmith\Support\Console\GeneratorCommand;
use Pluma\Support\Modules\Traits\ModulerTrait;
use Symfony\Component\Console\Input\InputOption;

class ForgeFactoryCommand extends GeneratorCommand
{
    use ModulerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'forge:factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return blacksmith_path('templates/factories/factory.stub');
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->option('model')
                        ? $this->qualifyClass($this->option('model'))
                        : 'Model';

        return str_replace(
            'DummyModel', $model, parent::buildClass($name)
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $module = $this->option('module');

        if (! $module || ! $this->isModule($module)) {
            $module = $this->choice("Specify the module the factory will belong to.", $this->modules());
        }

        $module = $this->getModulePath($module);

        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        );

        $databasePath = basename($this->webApp->databasePath());

        return "{$module}/{$databasePath}/factories/{$name}.php";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
            ['module', null, InputOption::VALUE_OPTIONAL, 'The module the factory belongs to.'],
        ];
    }
}
