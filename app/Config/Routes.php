<?php

namespace Config;

use CodeIgniter\Routing\RouterCollection;
use Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Dashboard::index', ['filter' => 'auth']);

$routes->match(['get', 'post'], 'login', 'AuthController::login', ['filter' => 'noauth']);
$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], static function (RouterCollection $routes): void {
    $routes->get('dashboard', 'Dashboard::index');

    $routes->group('bmn', static function (RouterCollection $routes): void {
        $routes->get('/', 'BMNController::index');
        $routes->match(['get', 'post'], 'create', 'BMNController::create');
        $routes->match(['get', 'post'], 'edit/(:num)', 'BMNController::edit/$1');
        $routes->post('delete/(:num)', 'BMNController::delete/$1');
        $routes->get('image/(:segment)', 'BMNController::image/$1');
    });

    $routes->group('maintenance', static function (RouterCollection $routes): void {
        $routes->get('/', 'MaintenanceController::index');
        $routes->match(['get', 'post'], 'create', 'MaintenanceController::create');
        $routes->match(['get', 'post'], 'edit/(:num)', 'MaintenanceController::edit/$1');
        $routes->post('delete/(:num)', 'MaintenanceController::delete/$1');
    });

    $routes->group('repair-requests', static function (RouterCollection $routes): void {
        $routes->get('/', 'RepairRequestController::index');
        $routes->match(['get', 'post'], 'create', 'RepairRequestController::create');
        $routes->match(['get', 'post'], 'edit/(:num)', 'RepairRequestController::edit/$1');
        $routes->post('delete/(:num)', 'RepairRequestController::delete/$1');
        $routes->get('detail/(:num)', 'RepairRequestController::show/$1');
        $routes->get('print/(:num)', 'RepairRequestController::print/$1');
        $routes->match(['get', 'post'], 'sign/(:num)', 'RepairRequestController::sign/$1');
    });

    $routes->group('users', ['filter' => 'role:admin'], static function (RouterCollection $routes): void {
        $routes->get('/', 'UserController::index');
        $routes->match(['get', 'post'], 'create', 'UserController::create');
        $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit/$1');
        $routes->post('delete/(:num)', 'UserController::delete/$1');
    });
});
