<?php
/**
 * 自动加载
 */
spl_autoload_register(function ($class_name) {
    $path = strtolower(dirname($class_name));
    $name = basename($class_name);
    $class_name = $path . '/' . $name;
    $class_name = str_replace('\\', '/', $class_name);
    $file_name  = $class_name . '.php';
    if (file_exists($file_name)) {
        require_once $file_name;
    }
}, true);