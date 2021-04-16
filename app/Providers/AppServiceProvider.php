<?php

namespace App\Providers;

use App\Helpers\Setting;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('setting',function(){
            return new Setting();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //override the infyom model generator to add extra informations
        $loader = AliasLoader::getInstance();
        $loader->alias('InfyOm\Generator\Generators\ModelGenerator','App\Overrides\infyomlabs\ModelGenerator');
    }
}
