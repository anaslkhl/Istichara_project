<?php



$router->get('/', 'personController@main');

$router->get('/admin', 'personController@admin');
$router->get('/main', 'personController@main');
$router->get('/form', 'personController@create');
$router->get('/professionals', 'personController@professionals');

$router->get('/avocat', 'avocatController@avocat');
$router->get('/huisser', 'huisserController@huisser');
$router->get('/person', 'personController@person');
