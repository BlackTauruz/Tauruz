<?php

namespace Blacktauruz\Tauruz\Providers;

use Blacktauruz\Tauruz\Commands\TranslationCommand;
use Blacktauruz\Tauruz\Commands\BreezeOrganizeCommand;
use Illuminate\Support\ServiceProvider;

class TauruzProvider extends ServiceProvider
{
    public function boot(): void
    {
        if($this->app->runningInConsole()){
            $this->commands([
                TranslationCommand::class,
                BreezeOrganizeCommand::class
            ]);
        }
    }
}
