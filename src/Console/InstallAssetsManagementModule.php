<?php

namespace Delickate\AssetsManagementModule\Console;

use Illuminate\Console\Command;

class InstallAssetsManagementModule extends Command
{
    protected $signature = 'assets-management:install';

    protected $description = 'Install Assets Management Module';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'assets-management-module'
        ]);

        $this->info('Assets management module installed successfully.');
    }
}