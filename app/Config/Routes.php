<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

// Equipment
$routes->post('/equipment/create', 'Equipment::create');
$routes->post('/equipment/createlog', 'Equipment::createLog');
// Stock Silo
$routes->post('/stocksilo/create', 'StockSilo::create');
$routes->get('/stocksilo', 'StockSilo::get');
$routes->get('/stocksilo/index', 'StockSilo::index');
$routes->get('/stocksilo/print', 'StockSilo::print');
// Report Cycletime
$routes->get('/reportcycletime', 'ReportCycletime::index');
$routes->get('/reportcycletime/(:any)', 'ReportCycletime::detail/$1');
// Report
$routes->get('/report', 'Report::index');
$routes->get('/report/(:any)', 'Report::print/$1');
// Status
$routes->get('status', 'Status::index');
// Report
$routes->get('/reportbyhour', 'ReportByHour::index');
$routes->get('/reportbyhour/(:any)', 'ReportByHour::print/$1');
