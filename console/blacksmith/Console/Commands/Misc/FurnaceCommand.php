<?php

namespace Blacksmith\Console\Commands\Misc;

use Illuminate\Support\Facades\File;
use Pluma\Support\Console\Command;
use Pluma\Support\Filesystem\Filesystem;

class FurnaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'draw:furnace
                            {--p|print : Print each line}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Draw a furnace';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->option('print')) {
        $text = "
         ___________________________
         _|__ _________________ __|__
        _|___||               ||_|__
        ___|_||      `)  '    ||___|_
         _|__||    ( ()\(     ||_|___
        ___|_||  ( ,|,(X)'    ||______
        _|___|| /,)/|`\``\\\  |||__|_
             ''---------------''  /  __
         ____    ___._____________ _
        ";
            $this->line("<comment>$text</comment>");
        } else {
            $this->line("<comment>");
            $this->line("       ___________________________"); sleep(1);
            $this->line("       _|__ _________________ __|__"); sleep(1);
            $this->line("      _|___||               ||_|__"); sleep(1);
            $this->line("      ___|_||      `)  '    ||___|_"); sleep(1);
            $this->line("       _|__||    ( ()\(     ||_|___"); sleep(1);
            $this->line("      ___|_||  ( ,|,(X)'    ||______"); sleep(1);
            $this->line("      _|___|| /,)/|`\``\\\  |||__|_"); sleep(1);
            $this->line("           ''---------------''  /  __"); sleep(1);
            $this->line("       ____    ___._____________ _");
            $this->line("</comment>");
        }


        $this->line("<comment>Credit: ejm</comment>");
    }
}
