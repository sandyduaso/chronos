<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;

class AppVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays the Pluma App version.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $version = $this->webApp->version();
        $caption = "Pluma CMS v{$version}";
        $text  = "╭".str_repeat("─", strlen($caption)+6)."╮\n";
        $text .= "│".str_repeat(" ", strlen($caption)+6)."│\n";
        $text .= "│   $caption   │\n";
        $text .= "│".str_repeat(" ", strlen($caption)+6)."│\n";
        $text .= "╰".str_repeat("─", strlen($caption)+6)."╯\n";

        $this->info($text);
    }
}
