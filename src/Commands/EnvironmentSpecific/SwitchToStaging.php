<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Commands;

use Exception;
use Illuminate\Console\Command;

class SwitchToStaging extends Command
{
    protected $signature = 'env:staging';
    protected $description = 'Switch your environment to staging.';

    /** @throws Exception */
    public function handle(): int
    {
        $this->call('env:switch', ['environment' => 'staging']);

        return self::SUCCESS;
    }
}
