<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Vault extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Tokenly\Vault\VaultServiceProvider::class
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
