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

        // システム管理者（role 0）のみを許可
        Gate::define('system', function($user){
            return ($user->role == 0);
        });

        // 管理者以上(role 5以上)に許可
        Gate::define('admin', function($user) {
            return ($user->role <=5);
        });

        Gate::define('user', function($user) {
            return ($user->role == 10);
        });
    }
}
