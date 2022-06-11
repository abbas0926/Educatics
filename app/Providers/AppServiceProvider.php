<?php

namespace App\Providers;

use App\Models\PromotionStudent;

use App\Observers\Tenant\PromotionStudentObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PromotionStudent::observe(PromotionStudentObserver::class);
    }
}
