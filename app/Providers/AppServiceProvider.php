<?php

namespace App\Providers;

use App\Listeners\UpdateLastLoginAt;
use App\Models\Basket;
use App\Models\BasketZone;
use App\Models\Employee;
use App\Models\EmployeeBasket;
use App\Models\EmployeeBasketZone;
use App\Models\Project;
use App\Models\RateCharged;
use App\Models\User;
use App\Observers\BasketObserver;
use App\Observers\BasketZoneObserver;
use App\Observers\EmployeeBasketObserver;
use App\Observers\EmployeeBasketZoneObserver;
use App\Observers\EmployeeObserver;
use App\Observers\ProjectObserver;
use App\Observers\RateChargedObserver;
use App\Policies\UserPolicy;
use Illuminate\Auth\Events\Login;
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
        Basket::observe(BasketObserver::class);
        BasketZone::observe(BasketZoneObserver::class);
        RateCharged::observe(RateChargedObserver::class);
        Employee::observe(EmployeeObserver::class);
        EmployeeBasket::observe(EmployeeBasketObserver::class);
        EmployeeBasketZone::observe(EmployeeBasketZoneObserver::class);
    }

    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Les événements mappés avec leurs écouteurs.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            UpdateLastLoginAt::class,
        ],
    ];
}
