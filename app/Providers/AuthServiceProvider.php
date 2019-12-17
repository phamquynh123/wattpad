<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permission;
use App\Models\User;

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

        $permissions = Permission::all();
        foreach ($permissions as $key => $permission) {
            Gate::define($permission->name, function($user) use ($permission) {
                // dd($user);
                $user_permissions = $user->role->permissions;
                foreach ($user_permissions as $user_permission) {
                    if ($permission->name == $user_permission->name) {
                        return true;
                    }
                }
            });
        }
        // dd( Gate::abilities() );
        Gate::define('admin', function ($user) {
            if ($user->role_id == config('Custom.roleAdmin')) {
                return true;
            } else return false;
        });
    }
}
