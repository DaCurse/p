<?php

use Framework\Core\AppFactory;

require_once 'lib/autoload.php';
require_once 'config.php';

$app = AppFactory::create_app(CACHE_FILE_PATH, ROUTE_DIR_PATH);
$app->start();
