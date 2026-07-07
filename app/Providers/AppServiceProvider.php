<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
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
        // spa password reset link.
        ResetPassword::createUrlUsing(fn ($user, string $token) => config('app.url')
            .'/reset-password/'.$token.'?email='.urlencode($user->getEmailForPasswordReset()));
    }
}
