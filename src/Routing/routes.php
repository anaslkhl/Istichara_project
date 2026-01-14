<?php



$router->get('/', 'personController@main');

$router->get('/admin', 'personController@admin');
$router->get('/main', 'personController@main');
$router->get('/form', 'personController@form');
$router->get('/professionals', 'personController@professionals');

$router->get('/avocat', 'avocatController@index');
$router->get('/huisser', 'huisserController@index');
$router->get('/person', 'personController@index');
