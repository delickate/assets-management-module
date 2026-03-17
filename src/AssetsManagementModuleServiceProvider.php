<?php

namespace Delickate\AssetsManagementModule;

use Illuminate\Support\ServiceProvider;

class AssetsManagementModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Module/AssetsManagement' => base_path('Modules/AssetsManagement'),
        ], 'assets-management-module');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallAssetsManagementModule::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}