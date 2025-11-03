<?php

if (! defined('APP_NAMESPACE')) {
    define('APP_NAMESPACE', 'App');
}

if (! defined('ENVIRONMENT')) {
    define('ENVIRONMENT', getenv('CI_ENVIRONMENT') ?: 'development');
}

if (! defined('APP_START_TIME')) {
    define('APP_START_TIME', microtime(true));
}

if (! defined('APP_START_MEM')) {
    define('APP_START_MEM', memory_get_usage());
}
