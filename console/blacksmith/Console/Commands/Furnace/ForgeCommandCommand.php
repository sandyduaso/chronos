<?php

namespace Blacksmith\Console\Commands\Furnace;

use Illuminate\Support\Facades\File;
use Blacksmith\Support\Console\Command;

class ForgeCommandCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forge:command
                           {name : The class name of the blacksmith command.}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a blacksmith console command.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO: forge:command
        $this->info("{$this->checkmark()} command not finished yet");
        $this->error("{$this->crossmark()} command not finished yet");
    }
}
