<?php

function my_autoload($my_class){


    $paths = [
        __DIR__ . '/Controllers/',
        __DIR__ . '/Services/',
        __DIR__ . '/Public/',
        __DIR__ . '/Connection/',
        __DIR__ . '/Repository/',
        __DIR__ . '/Entities/',
        __DIR__ . '/Routing/',
        __DIR__ . '/Routing/'
    ];

    foreach($paths as $path){

        $file = $path . $my_class . '.php';

        if(file_exists($file)){
            require_once($file);
            return;
        }
    }

}

spl_autoload_register('my_autoload');