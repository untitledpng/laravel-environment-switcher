<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Contracts\Repositories;

use Illuminate\Support\Collection;
use UntitledPng\LaravelEnvironmentSwitcher\Models\Environment;

interface EnvironmentRepositoryContract
{
    /** @return Collection<int, Environment> */
    public function getAll(): Collection;

    public function getByKey(string $key): ?Environment;
}
