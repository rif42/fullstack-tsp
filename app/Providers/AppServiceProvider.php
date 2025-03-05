<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\WorkOrder;
use App\Policies\WorkOrderPolicy;

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
        Paginator::useBootstrapFive();
        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            // Return the name of the policy class for the given model...
        });
        Gate::policy(WorkOrder::class, WorkOrderPolicy::class);
    }
}
