<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\BasketZone;
use App\Models\Employee;
use App\Models\HourlyRate;
use App\Models\Project;
use App\Observers\BasketObserver;
use App\Observers\BasketZoneObserver;
use App\Observers\EmployeeObserver;
use App\Observers\HourlyRateObserver;
use App\Observers\ProjectObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Project::observe(ProjectObserver::class);
        Employee::observe(EmployeeObserver::class);
        Basket::observe(BasketObserver::class);
        BasketZone::observe(BasketZoneObserver::class);
        HourlyRate::observe(HourlyRateObserver::class);
    }
}
