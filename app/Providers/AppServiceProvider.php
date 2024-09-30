<?php

namespace App\Providers;

use App\Repositories\RoleRepositoryImpl;
use App\Repositories\UserRepositoryImpl;
use App\Service\RoleServiceImpl;
use App\Service\UserServiceImpl;
use App\Service\ImgUrService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('roleRepository', function(){
            return new RoleRepositoryImpl();
        });

        $this->app->singleton('roleService', function(){
            return new RoleServiceImpl();
        });

        $this->app->singleton('userRepository', function(){
            return new UserRepositoryImpl();
        });

        $this->app->singleton('userService', function(){
            return new UserServiceImpl();
        });

        $this->app->singleton('imgur', function(){
            return new ImgUrService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
