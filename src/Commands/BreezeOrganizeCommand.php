<?php

namespace Blacktauruz\Tauruz\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class BreezeOrganizeCommand extends Command
{
    protected $signature = 'breeze:organize';

    protected $description = 'Breeze Organize';

    public function handle(): void
    {
        if ($this->confirm('Be careful, this command will replace existing files in your project. Do you wish to proceed?')) {
            //Controller`s Path
            (new Filesystem)->deleteDirectory(app_path('/Http/Controllers'));
            (new Filesystem)->copyDirectory(__DIR__ . "/../../stubs/Breeze/Controllers", app_path('/Http/Controllers'));

            //Routes`s Path
            (new Filesystem)->deleteDirectory(base_path('/routes'));
            (new Filesystem)->copyDirectory(__DIR__ . "/../../stubs/Breeze/routes", base_path('/routes'));
        }

        $this->info('Files successfully organized!');
    }
}
