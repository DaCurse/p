<?php

namespace Framework\Core;

use Framework\Caching\CacheManager;
use Framework\Routing\Router;

/**
 * Well known registered read-only providers (dynamic properties)
 * @property CacheManager $cache
 */
class App
{
    /** @var Router */
    private $router;
    /** @var object[] */
    private $providers;

    public function __construct($router)
    {
        $this->router = $router;
        $this->providers = [];
    }

    /**
     * @param string $name
     * @return false|object
     */
    public function __get($name)
    {
        if (isset($this->providers[$name])) return $this->providers[$name];
        return false;
    }

    /**
     * @param string $name
     * @param object $provider
     * @return void
     */
    public function register_provider($name, $provider)
    {
        $this->providers[$name] = $provider;
    }

    public function start()
    {
        $request_path = [get_class($this->router), 'get_request_path']();
        $route_result = $this->router->get_route($request_path);
        require_once $route_result->route_path;
    }
}
