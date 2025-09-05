# Laravel Environment Switcher

Switch between multiple .env files in your Laravel app with one command. Perfect for quickly toggling local, staging, and production configurations without manually copying files.

## Features
- Simple artisan command: `php artisan env:switch` (with prompt) or `php artisan env:switch production`
- Convenience commands: `env:local`, `env:staging`, `env:production`
- Safe by default: optional automatic backup of your current .env to `.env.backup`
- Configurable environments and file names via a publishable config file
- Rebuilds the config cache for you

## Installation
### Install via Composer:
```
composer require untitled_png/laravel-environment-switcher --dev
```

### (Optional) Publish the config to customize environments:
```
php artisan vendor:publish --tag=config --provider="UntitledPng\LaravelEnvironmentSwitcher\ServiceProvider"
```

### (Optional) Add to your `.gitignore` to ignore the new env files:
```
/.env.*
```

This package uses Laravel auto-discovery, so no manual service provider registration is required.

## Usage
- Interactive selection:
  - `php artisan env:switch`
  - You will be prompted to choose one of the configured environments.

- Direct switch by name:
  - `php artisan env:switch local`
  - `php artisan env:switch staging`
  - `php artisan env:switch production`

- Convenience commands:
  - `php artisan env:local`
  - `php artisan env:staging`
  - `php artisan env:production`

## Backups
The package will automatically backup your current `.env` file to `.env.backup` before switching. You can disable this behavior by setting `backup` to `false` in the config file. Or by setting the `ENV_SWITCHER_BACKUP` environment variable to `false`.

## ToDo
There are still many things I want to add to this package.

 - [ ] Add support for switching other files besides `.env`.
 - [ ] Display a message in the CLI which environment is currently active.
 - [ ] Display a UI component in the browser to view the current environment and even switch between them.

If you have any suggestions, please open an issue or pull request.

## License
MIT License. See LICENSE file if present.
