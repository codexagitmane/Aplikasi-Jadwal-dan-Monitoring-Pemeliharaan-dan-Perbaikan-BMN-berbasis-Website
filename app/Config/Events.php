<?php

namespace Config;

use CodeIgniter\Events\Events;

Events::on('pre_system', static function (): void {
    if (ENVIRONMENT !== 'testing') {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }
});
