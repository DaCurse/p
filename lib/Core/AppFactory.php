<?php

namespace P\Core;

use P\Caching\CacheManager;
use P\Routing\Router;
use P\Serialization\PHPSerializer;

/**
 * Creates all needed dependencies for an App instance and returns a new one
 */
class AppFactory
{
    /**
     * No constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $cache_path
     * @param string $route_dir
     * @return App
     */
    public static function create_app($cache_path, $route_dir)
    {
        $cache_serializer = new PHPSerializer();
        $cache_manager = new CacheManager($cache_path, $cache_serializer);

        $routes = $cache_manager->get('routes');
        if (!$routes) {
            $routes = Router::load_routes($route_dir);
            $cache_manager->set('routes', $routes, ROUTE_CACHE_TTL);
        }
        $router = new Router($route_dir, $routes);

        $app = new App($router);
        $app->register_provider('cache', $cache_manager);
        return $app;
    }
}
