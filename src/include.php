<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/12
 * Time: 18:47
 */

spl_autoload_register(function ($classname) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    $path = str_replace('Eccang\OpenApi\\', '', $path);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
