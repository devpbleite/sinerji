<?php

use App\Controllers\CarsController;
use App\Controllers\CategoriesController;
use App\Controllers\CompanyController;
use App\Controllers\CustomersController;
use App\Controllers\HomeController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 * 
 */


$routes->get('/', [HomeController::class, 'index'], ['as' => 'home']); 

$routes->group('categories', static function ($routes) {
    $routes->get('/', [CategoriesController::class, 'index'], ['as' => 'categories']); 
    $routes->get('new', [CategoriesController::class, 'new'], ['as' => 'categories.new']); 
    $routes->post('create', [CategoriesController::class, 'create'], ['as' => 'categories.create']); 
    $routes->get('edit/(:segment)', [CategoriesController::class, 'edit/$1'], ['as' => 'categories.edit']); 
    $routes->put('update/(:segment)', [CategoriesController::class, 'update/$1'], ['as' => 'categories.update']); 
    $routes->delete('delete/(:segment)', [CategoriesController::class, 'delete/$1'], ['as' => 'categories.delete']); 
});

$routes->group('customers', static function ($routes) {
    $routes->get('/', [CustomersController::class, 'index'], ['as' => 'customers']); 
    $routes->get('new', [CustomersController::class, 'new'], ['as' => 'customers.new']); 
    $routes->get('show/(:segment)', [CustomersController::class, 'show/$1'], ['as' => 'customers.show']); 
    $routes->post('create', [CustomersController::class, 'create'], ['as' => 'customers.create']); 
    $routes->get('edit/(:segment)', [CustomersController::class, 'edit/$1'], ['as' => 'customers.edit']); 
    $routes->put('update/(:segment)', [CustomersController::class, 'update/$1'], ['as' => 'customers.update']); 
    $routes->delete('delete/(:segment)', [CustomersController::class, 'delete/$1'], ['as' => 'customers.delete']); 

$routes->group('cars', static function ($routes) {
    $routes->get('all/(:segment)', [CarsController::class, 'all/$1'], ['as' => 'customers.cars']); 
    $routes->get('new/(:segment)', [CarsController::class, 'new/$1'], ['as' => 'customers.cars.new']); 
    $routes->get('edit/(:segment)', [CarsController::class, 'edit/$1'], ['as' => 'customers.cars.edit']); 
    $routes->post('create', [CarsController::class, 'create'], ['as' => 'customers.cars.create']); 
    $routes->put('update/(:segment)', [CarsController::class, 'update/$1'], ['as' => 'customers.cars.update']); 
    $routes->delete('delete/(:segment)', [CarsController::class, 'delete/$1'], ['as' => 'customers.cars.delete']); 
});

$routes->group('company', static function ($routes) {
    $routes->get('/', [CompanyController::class, 'index'], ['as' => 'company']); 
    $routes->match(['post', 'put'], 'process', [CompanyController::class, 'process'], ['as' => 'company.process']); 
});
