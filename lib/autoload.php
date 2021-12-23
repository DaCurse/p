<?php

spl_autoload_register(function ($cls) {
    $pos = strpos($cls, '\\');
    $path = str_replace('\\', DIRECTORY_SEPARATOR, substr($cls, $pos + 1));
    require_once "$path.php";
});
