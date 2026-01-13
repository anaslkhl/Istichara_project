<?php


$routers = new Routing;

$routers->get('/', '../Public/index');
$routers->get('/', '../Public/avocat');
$routers->get('/', '../Public/huisser');

$routers->get('/', '../Entities/Person');
$routers->get('/', '../Entities/Avocat');
$routers->get('/', '../Entities/Huisser');