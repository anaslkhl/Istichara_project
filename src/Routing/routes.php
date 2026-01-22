<?php



$router->get('/', 'personController@main');

$router->get('/admin', 'personController@admin');
$router->get('/main', 'personController@main');
$router->get('/dashboard', 'personController@dashboard');
$router->get('/form/{id}', 'personController@edit');
$router->get('/form', 'personController@create');
$router->post('/store', 'personController@store');
$router->post('/delete', 'personController@delete');
$router->post('/update', 'personController@update');
$router->get('/professionals', 'personController@professionals');
$router->get('/clientInscription', 'personController@clientInscription');
$router->get('/avocat', 'avocatController@avocat');
$router->get('/huisser', 'huisserController@huisser');
$router->get('/person', 'personController@person');
$router->get('/availability', 'availabilityController@availability');
$router->get('/insertAvailability', 'availabilityController@insertAvailability');

   