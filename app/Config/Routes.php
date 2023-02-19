<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers' );
$routes->setDefaultController('HomeController' );
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->set404Override(function(){
//    return view("page_not_found");
//});

$routes->get('/', 'HomeController::index');
$routes->match((['post','get']), 'get-city', 'UserAdsController::getCity');
$routes->get('about', 'HomeController::about');
$routes->get('faqs', 'HomeController::faqs');
$routes->get('services', 'HomeController::service');
$routes->get('rates', 'HomeController::rate');
$routes->match(['post', 'get'], 'contact-us', 'HomeController::contact');
$routes->get('blogs', 'HomeController::blogs');

$routes->get('admin', 'Admin\LoginController::index');
$routes->group('admin', function ($route) {

    /*Admin Login Routes*/
    $route->get('login', 'Admin\LoginController::index');
    $route->post('login', 'Admin\LoginController::adminLogin');
    $route->get('logout', 'Admin\LoginController::adminLogout');

    $route->match(['post', 'get'],'change-password', 'Admin\LoginController::changePassword' , ["filter"=>"admin"]);
    $route->get('profile', 'Admin\LoginController::adminProfile', ["filter"=>"admin"]);
    $route->post('profile/update', 'Admin\LoginController::updateProfile', ["filter"=>"admin"]);

    /*dashboard*/
    $route->get('dashboard', 'Admin\DashboardController::index', ["filter"=>"admin"]);

    /* Category*/
    $route->match( (['post','get']), 'category', 'Admin\CategoryController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'category/add', 'Admin\CategoryController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'category/(:num)', 'Admin\CategoryController::update/$1' , ["filter"=>"admin"]);
    $route->get('category/delete/(:num)', 'Admin\CategoryController::delete/$1' , ["filter"=>"admin"]);

    /*Escort*/
    $route->match( (['post','get']), 'escort', 'Admin\EscortController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'escort/add', 'Admin\EscortController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'escort/(:num)', 'Admin\EscortController::update/$1' , ["filter"=>"admin"]);
    $route->get('escort/delete/(:num)', 'Admin\EscortController::delete/$1' , ["filter"=>"admin"]);

    /* city*/
    $route->match( (['post','get']), 'city', 'Admin\CityController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'city/add', 'Admin\CityController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'city/edit/(:num)', 'Admin\CityController::update/$1' , ["filter"=>"admin"]);
    $route->get('city/delete/(:num)', 'Admin\CityController::delete/$1' , ["filter"=>"admin"]);

    /* state*/
    $route->match( (['post','get']), 'state', 'Admin\StateController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'state/add', 'Admin\StateController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'state/edit/(:num)', 'Admin\StateController::update/$1' , ["filter"=>"admin"]);
    $route->get('state/delete/(:num)', 'Admin\StateController::delete/$1' , ["filter"=>"admin"]);

    /*Blog*/
    $route->match( (['post','get']), 'blog', 'Admin\BlogController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'blog/add', 'Admin\BlogController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'blog/(:num)', 'Admin\BlogController::update/$1' , ["filter"=>"admin"]);
    $route->get('blog/delete/(:num)', 'Admin\BlogController::delete/$1' , ["filter"=>"admin"]);

    /*FAQs*/
    $route->match( (['post','get']), 'faqs', 'Admin\FaqsController::index' , ["filter"=>"admin"]);
    $route->match(['post','get'],'faqs/add', 'Admin\FaqsController::add' , ["filter"=>"admin"]);
    $route->match(['post','get'],'faqs/(:num)', 'Admin\FaqsController::update/$1' , ["filter"=>"admin"]);
    $route->get('faqs/delete/(:num)', 'Admin\FaqsController::delete/$1' , ["filter"=>"admin"]);


    /*search engine*/
    $route->get('search-engine/(:alpha)/(:any)', 'Admin\SearchController::index/$1/$2' , ["filter"=>"admin"]);
});

$routes->get('/blog/(:any)', 'PageController::blog_post/$1');
$routes->get('(:any)', 'PageController::service_post/$1');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
