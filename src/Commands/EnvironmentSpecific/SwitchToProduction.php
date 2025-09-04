<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Commands;

use Exception;
use Illuminate\Console\Command;

class SwitchToProduction extends Command
{
    protected $signature = 'env:production';
    protected $description = 'Switch your environment to production.';

    /** @throws Exception */
    public function handle(): int
    {
        $this->call('env:switch', ['environment' => 'production']);

        return self::SUCCESS;
    }
}
