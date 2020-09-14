<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');

$routes->get('ipam', 'Ipam::index');
$routes->get('ipam/create', 'Ipam::create');
$routes->post('ipam/store', 'Ipam::store');
$routes->get('ipam/edit/(:num)', 'Ipam::edit/$1');
$routes->post('ipam/update/(:num)', 'Ipam::update/$1');
$routes->get('ipam/delete/(:num)', 'Ipam::delete/$1');
$routes->get('ipam/export', 'Ipam::exportCsv');

$routes->get('calculator', 'Calculator::index');
$routes->post('calculator/calculate', 'Calculator::calculate');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
