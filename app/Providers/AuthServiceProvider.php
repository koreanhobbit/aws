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
        $this->registerTeamProfilePolicies();

        //
    }

    public function registerTeamProfilePolicies() {
        Gate::define('super-admin', function($user) {
            return $user->inRole('super_admin');
        });

        Gate::define('access-blog', function($user) {
            return $user->hasAccess(['access-blog']);
        });

        Gate::define('access-portfolio', function($user) {
            return $user->hasAccess(['access-portfolio']);
        });
    }
}
