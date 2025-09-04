<?php

namespace UntitledPng\LaravelEnvironmentSwitcher\Commands;

use Exception;
use Illuminate\Console\Command;

class SwitchToLocal extends Command
{
    protected $signature = 'env:local';
    protected $description = 'Switch your environment to local.';

    /** @throws Exception */
    public function handle(): int
    {
        $this->call('env:switch', ['environment' => 'local']);

        return self::SUCCESS;
    }
}
