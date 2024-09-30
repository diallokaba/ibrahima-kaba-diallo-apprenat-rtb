<?php

namespace App\Providers;

use App\Service\FirebaseService;
use Illuminate\Support\ServiceProvider;

class FirebaseAuthProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('firebaseauth', function(){
            return new FirebaseService();
        });
    }

    public function boot(){

    }
}