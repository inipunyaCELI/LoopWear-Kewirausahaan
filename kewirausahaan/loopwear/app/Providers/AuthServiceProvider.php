<?php

namespace App\Providers;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];
    public function boot(): void
    {
        $this->registerPolicies();
        ResetPassword::createUrlUsing(function (object $user, string $token) {
            return 'http://127.0.0.1:8000/reset-password/' . $token . '?email=' . urlencode($user->email);
        });
    }
}