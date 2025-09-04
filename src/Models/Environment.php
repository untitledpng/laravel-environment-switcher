<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Models;

use UntitledPng\LaravelEnvironmentSwitcher\Contracts\Models\EnvironmentContract;

readonly class Environment implements EnvironmentContract
{
    public string $envFilePath;

    public function __construct(public string $environment, array $data)
    {
        $this->envFilePath = $data['env_file_path'];
    }
}
