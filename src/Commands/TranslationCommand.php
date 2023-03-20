<?php

namespace Blacktauruz\Tauruz\Commands;

use Directory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslationCommand extends Command
{
    protected $signature = 'lang:translate
        {locale : Abbreviation of the desired location. E.g. en_US, pt_BR}
        {--U|update : Updates configuration files for the selected location}';

    protected $description = 'Install translation files for selected language';

    public function handle(): void
    {
        $locale = $this->argument('locale');

        if(File::exists(__DIR__."/../../lang/{$locale}")){
            if(File::exists(lang_path($locale))){
                if(!$this->confirm('Translation files already exist for the chosen locale. Do you want to replace?')){
                    $this->info('Translation installation cancelled.');
                    return;
                }
            }

            File::copyDirectory(__DIR__."/../../lang/{$locale}", lang_path($locale));
            File::copy(__DIR__."/../../lang/{$locale}.json", lang_path("{$locale}.json"));

            $this->info('Translation files for '.$locale.' installed successfully!');

            return;
        }

        $this->alert('Localization has not yet been integrated. But nothing prevents you from requesting it in our git (https://github.com/BlackTauruz/Tauruz).');
    }
}
