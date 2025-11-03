<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Logger extends BaseConfig
{
    public array|int|string $threshold = 4;

    public array $handlers = [
        'CodeIgniter\\Log\\Handlers\\FileHandler' => [
            'handles'    => ['critical', 'alert', 'emergency', 'debug', 'error', 'info', 'notice', 'warning'],
            'path'       => WRITEPATH . 'logs/',
            'fileExtension' => 'log',
            'filePermissions' => 0644,
        ],
    ];
}
