<?php

namespace P\Core;

use P\Caching\CacheManager;
use P\Routing\Router;

/**
 * Main flow handler
 * @property CacheManager $cache Dynamically injected cache manager instance
 */
class App
{
    /** @var Router */
    private $router;
    /**
     * @var object[]
     * List of useful instances that can be accessed from an App instance
     */
    private $providers;

    /**
     * @param Router $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->providers = [];
    }

    /**
     * Get a registered provider instance
     * @param string $name
     * @return false|object
     */
    public function __get($name)
    {
        if (isset($this->providers[$name])) return $this->providers[$name];
        return false;
    }

    /**
     * Register a provider instance
     * @param string $name
     * @param object $provider
     * @return void
     */
    public function register_provider($name, $provider)
    {
        $this->providers[$name] = $provider;
    }

    /**
     * Main application logic, parses request, loads correct route and returns a response
     * @return void
     */
    public function start()
    {
        $request_path = [get_class($this->router), 'get_request_path']();
        $route_result = $this->router->get_route($request_path);
        require_once $route_result->route_path;
    }
}
