<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\Project;
use App\Observers\EmployeeObserver;
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
    }
}
