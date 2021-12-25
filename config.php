<?php

const CACHE_DEFAULT_TTL = 3600;

const ROUTE_EXT = 'php';
const ROUTE_PARAM_PREFIX = '$';
const ROUTE_CACHE_TTL = 1800;

const CACHE_FILE_PATH = './data/cache';
if (!realpath(CACHE_FILE_PATH)) {
    file_put_contents(CACHE_FILE_PATH, '');
}

const ROUTE_DIR_PATH = './routes';
if (!is_dir(ROUTE_DIR_PATH)) {
    mkdir(ROUTE_DIR_PATH, 0774, true);
}