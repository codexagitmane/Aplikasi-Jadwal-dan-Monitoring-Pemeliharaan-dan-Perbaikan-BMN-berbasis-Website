<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'    => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth'    => \App\Filters\AuthFilter::class,
        'role'    => \App\Filters\RoleFilter::class,
        'noauth'  => \App\Filters\NoAuthFilter::class,
    ];

    public array $globals = [
        'before' => [
            'csrf'
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}
