<?php

namespace App\Providers;

use App\Database\NeonPostgresConnector;
use Illuminate\Database\PostgresConnection;
use Illuminate\Support\Facades\DB;
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
        DB::extend('pgsql', function (array $config, string $name) {
            $connector = new NeonPostgresConnector();
            $config['name'] = $name;

            return new PostgresConnection(
                $connector->connect($config),
                $config['database'],
                $config['prefix'] ?? '',
                $config,
            );
        });
    }
}
