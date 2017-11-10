<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('operation-access', function($user){
            return $user->role == "operation";
        });

        Gate::define('marketing-access', function($user){
            return $user->role == "marketing";
        });

        Gate::define('payable-access', function($user){
            return $user->role == "payable";
        });

        Gate::define('pricing-access', function($user){
            return $user->role == "pricing";
        });

        Gate::define('invoice-access', function($user){
            return $user->role == "invoice";
        });

        Gate::define('admin-access', function($user){
            return $user->role == "admin";
        });

        Gate::define('admin2-access', function($user){
            return $user->role == "admin2";
        });

        Gate::define('approvepay-access', function($user){
            return $user->role == "approvepay";
        });

        Gate::define('pajak-access', function($user){
            return $user->role == "pajak";
        });

        Gate::define('receivable-access', function($user){
            return $user->role == "receivable";
        });

        Gate::define('approverec-access', function($user){
            return $user->role == "approverec";
        });

        Gate::define('manager-access', function($user){
            return $user->role == "manager";
        });
    }
}
