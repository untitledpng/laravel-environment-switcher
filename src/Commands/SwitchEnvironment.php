<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use UntitledPng\LaravelEnvironmentSwitcher\Contracts\Models\EnvironmentContract;
use UntitledPng\LaravelEnvironmentSwitcher\Contracts\Repositories\EnvironmentRepositoryContract;

class SwitchEnvironment extends Command
{
    protected $signature = 'env:switch {environment?}';
    protected $description = 'Switch to a different environment.';

    /** @throws Exception */
    public function handle(): int
    {
        $this->alert('Switching environment...');
        $environment = $this->getEnvironment();

        $this->validate($environment);

        if (config('environment-switcher.backup.env_file')) {
            $this->backupEnvFile();
        }

        $this->copyEnvFile($environment);

        $this->call('config:cache');

        return self::SUCCESS;
    }

    protected function copyEnvFile(EnvironmentContract $environment): void
    {
        $this->comment('Copying environment file...');
        File::copy(base_path($environment->envFilePath), base_path('.env'));
    }

    protected function backupEnvFile(): void
    {
        $this->comment('Creating backup of the environment file...');
        File::copy(base_path('.env'), base_path('.env.backup'));
    }

    protected function getEnvironment(): EnvironmentContract
    {
        $environment = $this->argument('environment') ?? $this->choseEnvironment();

        if ( ! config("environment-switcher.environments.{$environment}")) {
            throw new Exception("Environment {$environment} does not exist in config/environment-switcher.php.");
        }

        return app(EnvironmentRepositoryContract::class)->getByKey($environment);
    }

    protected function choseEnvironment(): string
    {
        $environments = app(EnvironmentRepositoryContract::class)
            ->getAll()
            ->mapWithKeys(static fn (EnvironmentContract $environment, string $key) => [$key => $key])
            ->all();

        return $this->choice('Select a environment', $environments);
    }

    protected function validate(EnvironmentContract $environment): void
    {
        $this->comment('Validating environment files...');

        if ( ! File::exists(base_path('.env'))) {
            throw new Exception('No .env file found.');
        }

        if ( ! File::exists(base_path($environment->envFilePath))) {
            throw new Exception("No {$environment->envFilePath} file found.");
        }
    }
}
