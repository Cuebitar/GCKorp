<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Passport::personalAccessClientSecret(config('rtTT0NknNBmKGpMmrHn9Cw1SoYE62n1DrVW93gst'));
        //Passport::personalAccessClientId(config(2));//
    }
}
