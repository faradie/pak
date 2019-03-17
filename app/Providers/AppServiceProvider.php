<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    //     \Carbon\Carbon::setLocale('id');
    // // jika ingin menyesuaikan dengan dengan locale di laravel
    //     \Carbon\Carbn::setLocale(config('app.locale'));
    //     config(['app.locale' => 'id']);
    //     \Carbon\Carbon::setLocale('id');
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
