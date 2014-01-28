<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

define('DS', DIRECTORY_SEPARATOR);

set_include_path(implode(PATH_SEPARATOR, array(
    __DIR__ . '/../src',
    get_include_path(),
)));

spl_autoload_register(
    function($className) {
        $filename = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $path .= DIRECTORY_SEPARATOR . $filename;
            if (is_file($path)) {
                require_once $path;
                return true;
            }
        }
        return false;
    }
);