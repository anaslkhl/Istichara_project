<?php

function my_autoload($my_class){


    $file = __DIR__ . '/includes/' . '$my_clas' . '.php';

    if(file_exists($file)){
        require_once $file;
    }
}
