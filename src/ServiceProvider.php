<?php

namespace UntitledPng\LaravelEnvironmentSwitcher;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use UntitledPng\LaravelEnvironmentSwitcher\Commands\SwitchEnvironment;
use UntitledPng\LaravelEnvironmentSwitcher\Commands\SwitchToLocal;
use UntitledPng\LaravelEnvironmentSwitcher\Commands\SwitchToProduction;
use UntitledPng\LaravelEnvironmentSwitcher\Commands\SwitchToStaging;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerModels();
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/environment-switcher.php' => config_path('environment-switcher.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../config/environment-switcher.php', 'environment-switcher'
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                SwitchEnvironment::class,
                SwitchToLocal::class,
                SwitchToStaging::class,
                SwitchToProduction::class,
            ]);
        }
    }

    private function registerRepositories(): void
    {
        $this->app->singleton(
            \UntitledPng\LaravelEnvironmentSwitcher\Contracts\Repositories\EnvironmentRepositoryContract::class,
            \UntitledPng\LaravelEnvironmentSwitcher\Repositories\EnvironmentRepository::class,
        );
    }

    private function registerModels(): void
    {
        $this->app->bind(
            \UntitledPng\LaravelEnvironmentSwitcher\Contracts\Models\EnvironmentContract::class,
            \UntitledPng\LaravelEnvironmentSwitcher\Models\Environment::class
        );
    }
}
