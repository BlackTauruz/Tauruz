<?php

namespace Blacktauruz\Tauruz\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class TranslationCommand extends Command
{
    protected $signature = 'lang:translate
        {locale : Abbreviation of the desired location. E.g. en_US, pt_BR}
        {--U|update : Updates configuration files for the selected location}';

    protected $description = 'Install translation files for selected language';

    public function handle(): void
    {
        $locale = $this->argument('locale');

        (new Filesystem)->ensureDirectoryExists(__DIR__."/../../lang");

        if((new Filesystem)->exists(__DIR__."/../../lang/{$locale}")){
            if((new Filesystem)->exists(lang_path($locale))){
                if(!$this->confirm('Translation files already exist for the chosen locale. Do you want to replace?')){
                    $this->info('Translation installation cancelled.');
                    return;
                }
            }

            (new Filesystem)->copyDirectory(__DIR__."/../../lang/{$locale}", lang_path($locale));
            (new Filesystem)->copy(__DIR__."/../../lang/{$locale}.json", lang_path("{$locale}.json"));

            $this->info('Translation files for '.$locale.' installed successfully!');

            return;
        }

        $this->alert('Localization has not yet been integrated. But nothing prevents you from requesting it in our git (https://github.com/BlackTauruz/Tauruz).');
    }
}
