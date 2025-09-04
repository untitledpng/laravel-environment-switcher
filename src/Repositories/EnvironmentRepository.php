<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Repositories;

use Illuminate\Support\Collection;
use UntitledPng\LaravelEnvironmentSwitcher\Contracts\Repositories\EnvironmentRepositoryContract;
use UntitledPng\LaravelEnvironmentSwitcher\Models\Environment;

class EnvironmentRepository implements EnvironmentRepositoryContract
{
    public function getAll(): Collection
    {
        return Collection::make(config('environment-switcher.environments'))
            ->transform(static fn (array $data, string $environment) => new Environment($environment, $data));
    }

    public function getByKey(string $environment): ?Environment
    {
        $data = config("environment-switcher.environments.{$environment}");

        if ( ! $data) {
            return null;
        }

        return new Environment($environment, $data);
    }
}
