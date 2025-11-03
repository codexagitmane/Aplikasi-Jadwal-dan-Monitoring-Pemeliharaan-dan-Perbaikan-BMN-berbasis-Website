<?php

declare(strict_types=1);

use Config\Paths;
use Config\Services;

define('ROOTPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
define('WRITEPATH', ROOTPATH . 'writable' . DIRECTORY_SEPARATOR);
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

require ROOTPATH . 'vendor/autoload.php';

define('ENVIRONMENT', getenv('CI_ENVIRONMENT') ?: 'development');

$paths = new Paths();

require_once APPPATH . 'Config/Constants.php';
require_once APPPATH . 'Config/Boot/' . ENVIRONMENT . '.php';
require_once APPPATH . 'Common.php';

define('SYSTEMPATH', realpath($paths->systemDirectory) . DIRECTORY_SEPARATOR);

$app = Services::codeigniter();
$app->initialize();
$app->run();
