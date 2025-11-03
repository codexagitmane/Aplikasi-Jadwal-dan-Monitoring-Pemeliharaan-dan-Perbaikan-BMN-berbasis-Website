<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    public array $psr4 = [
        'App'    => APPPATH,
        'Config' => APPPATH . 'Config',
    ];

    public array $classmap = [];

    public array $files = [];

    public array $helpers = ['form', 'url'];
}
