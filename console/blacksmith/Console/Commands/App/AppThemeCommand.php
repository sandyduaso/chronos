<?php

namespace Blacksmith\Console\Commands\App;

use Blacksmith\Support\Console\Command;
use Setting\Models\Setting;
use Theme\Models\Theme;

class AppThemeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the theme of the app.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(__("Getting installed theme lists..."));

        $themes = [];
        foreach (Theme::themes() as $theme) {
            $themes[] = $theme->name;
        }

        $theme = $this->choice("Please select a theme", $themes);
        $theme = Theme::theme($theme);

        $this->info(__("Activating {$theme->name}..."));
        Setting::updateOrCreate(['key' => 'active_theme'], ['value' => $theme->code]);
        $this->info(__("Done."));
    }
}
