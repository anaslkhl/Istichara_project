<?php



$router->get('/', 'personController@main');

$router->get('/admin', 'personController@admin');
$router->get('/main', 'personController@main');
$router->get('/form', 'personController@create');
$router->post('/store', 'personController@store');
$router->post('/delete', 'personController@delete');
$router->get('/professionals', 'personController@professionals');

$router->get('/avocat', 'avocatController@avocat');
$router->get('/huisser', 'huisserController@huisser');
$router->get('/person', 'personController@person');


