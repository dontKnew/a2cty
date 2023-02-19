/*Blog*/
$route->match( (['post','get']), 'faqs', 'Admin\FaqsController::index' , ["filter"=>"admin"]);
$route->match(['post','get'],'faqs/add', 'Admin\FaqsController::add' , ["filter"=>"admin"]);
$route->match(['post','get'],'faqs/(:num)', 'Admin\FaqsController::update/$1' , ["filter"=>"admin"]);
$route->get('faqs/delete/(:num)', 'Admin\FaqsController::delete/$1' , ["filter"=>"admin"]);