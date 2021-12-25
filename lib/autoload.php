<?php

/**
 * Autoload mentioned classes
 * @param string $class
 */
spl_autoload_register(function ($class) {
    $separator_pos = strpos($class, '\\');
    $class_path = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $separator_pos + 1));
    require_once __DIR__ . DIRECTORY_SEPARATOR . "$class_path.php";
});
