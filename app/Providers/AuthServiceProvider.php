<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\TokenGuard; //added
use Illuminate\Support\Facades\Auth; //added

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        /*  added for API   */
        Auth::extend('token', function ($app, $name, array $config) {
            return new TokenGuard(Auth::createUserProvider($config['provider']), $app->request);
        });
    }
}
