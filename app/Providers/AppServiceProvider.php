<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Schema;

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
        Schema::defaultStringLength(191);
        Gate::define('admin-access', function (User $user) {
            $admins = ['admin@tutorlink.com', 'naveed@admin.com'];
            return in_array($user->email, $admins) && $user->role === 'admin';
        });
    }
}
