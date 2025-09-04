<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backup
    |--------------------------------------------------------------------------
    |
    | This value determines if the current environment should be backed up
    | before switching to the new environment.
    |
    */

    'backup' => [
        'env_file' => env('ENV_SWITCHER_BACKUP_ENV_FILE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Environments
    |--------------------------------------------------------------------------
    |
    | Set different environments and their corresponding environment files.
    |
    */

    'environments' => [
        'local' => [
            'env_file_path' => '.env.local',
        ],
        'staging' => [
            'env_file_path' => '.env.staging',
        ],
        'production' => [
            'env_file_path' => '.env.production',
        ],
    ],
];
