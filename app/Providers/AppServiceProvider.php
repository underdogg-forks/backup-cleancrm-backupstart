<?php

namespace App\Providers;

use App\Support\Directory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $modules = Directory::listDirectories(base_path('Modules'));


        foreach ($modules as $module) {

            //$helpersPath = base_path('Modules/' . $module . '/Helpers');
            $routesPath = base_path('Modules/' . $module . '/Routes');
            $viewsPath = base_path('Modules/' . $module . '/Views');

            /*
                        if (file_exists($routesPath)) {
                            require $routesPath;
                        }
            */
            $routesFiles = Directory::listContents($routesPath);
            //dd($routesfiles);


            foreach ($routesFiles as $routesFile) {
                if (file_exists($routesPath . '/' . $routesFile)) {
                    require $routesPath . '/' . $routesFile;
                } else {
                    dd($routesPath . '/' . $routesFile);
                }
            }


            if (file_exists($viewsPath)) {
                $this->app->view->addLocation($viewsPath);
            } else {
dd($viewsPath);
            }


            /*
                    foreach (File::files(app_path('Helpers')) as $helper) {
                        require_once $helper;
                    }
            */

            //$this->app->register('IP\Providers\ConfigServiceProvider');
            //$this->app->register('IP\Providers\EventServiceProvider');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
