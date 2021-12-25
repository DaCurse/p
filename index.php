<?php

use P\Core\AppFactory;

require_once 'lib/autoload.php';
require_once 'config.php';

$app = AppFactory::create_app(realpath(CACHE_FILE_PATH), realpath(ROUTE_DIR_PATH));
$app->start();