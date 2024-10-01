<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Paper;
use App\Observers\PaperObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // parent::boot();
        Paper::observe(PaperObserver::class);
    }
}
