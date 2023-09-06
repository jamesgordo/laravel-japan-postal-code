<?php

namespace JamesGordo\JapanPostalCode\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        // routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
