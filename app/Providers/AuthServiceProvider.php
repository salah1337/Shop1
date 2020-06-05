<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        'App\Models\Order' => 'App\Policies\OrderPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Ability' => 'App\Policies\AbilityPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('ability-view', 'AbilityPolicy@viewAny');
        Passport::routes(function ($router){
            $router->forAccessTokens();
        });
    }
}
