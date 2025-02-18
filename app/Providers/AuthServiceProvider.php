<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\AdminPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Add your model to policy mappings here if needed
        // Example: \App\Models\Post::class => \App\Policies\PostPolicy::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define gates
        Gate::define('view-results', [AdminPolicy::class, 'view']);
    }
}
