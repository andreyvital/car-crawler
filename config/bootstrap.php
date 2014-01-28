<?php

ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

define('DS', DIRECTORY_SEPARATOR);

set_include_path(implode(PATH_SEPARATOR, array(
    __DIR__ . '/../src',
    get_include_path(),
)));

spl_autoload_register(function ($class) {
  $filename = sprintf('%s.php', str_replace('\\', DS, $class));
  
  if (($class = stream_resolve_include_path($filename)) !== false) {
    require $class;
  }
});
