<?php

namespace Domains\Tasks\Infrastructure\Framework\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $domainNamespace = 'Domains\Tasks\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $this->app->router
        ->group([
            'namespace' => 'App\Http\Controllers',
            'prefix'    => 'tasks',
        ], function ($router) {
            require __DIR__ . '/../Routes/api.php';
        });
    }
}
