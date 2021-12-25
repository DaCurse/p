<?php

namespace P\Routing;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Handles loading and parsing requests into routes
 */
class Router
{
    /** @var string */
    private $base_dir;
    /** @var ParamRoute[] */
    private $param_routes;

    /**
     * @param string $base_dir
     * @param ParamRoute[] $param_routes
     */
    public function __construct($base_dir, $param_routes)
    {
        $this->base_dir = $base_dir;
        $this->param_routes = $param_routes;
    }

    /**
     * Recursively loads all parameterized routes in a directory
     * @param $route_dir
     * @return ParamRoute[]
     */
    public static function load_routes($route_dir)
    {
        $routes = [];
        $route_dir = realpath($route_dir);
        $it = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($route_dir)
        );
        /** @var SplFileInfo $file */
        foreach ($it as $file) {
            if ($file->isDir() || $file->getExtension() !== ROUTE_EXT) continue;
            $route_path = substr(
                str_replace('\\', '/', $file->getPathname()),
                strlen($route_dir) + 1
            );
            $route_parts = ParamRoute::parse_path($route_path);
            if ($route_parts) $routes[] = new ParamRoute($route_path, $route_parts);
        }

        return $routes;
    }

    /**
     * Returns the requested path from the current request
     * @return string
     */
    public static function get_request_path()
    {
        $parts = explode('/', substr($_SERVER['PHP_SELF'], 1), 2);
        return isset($parts[1]) ? $parts[1] : '';
    }

    /**
     * Tries to return a route result for a requested path, along with
     * any parameters if the matched route is parameterized
     * @param $request_path
     * @return false|RouteResult
     */
    public function get_route($request_path)
    {
        if ($result = $this->get_file($request_path))
            return $result;
        if ($result = $this->get_file("$request_path/index"))
            return $result;

        foreach ($this->param_routes as $route) {
            if ($param_values = $route->match($request_path))
                return new RouteResult($route->route_path, $param_values);
        }

        return false;
    }

    /**
     * Tries to return a route result for a file
     * @param string $request_path
     * @return false|RouteResult
     */
    private function get_file($request_path)
    {
        $route_path = realpath(
            "$this->base_dir/$request_path." . ROUTE_EXT
        );
        return file_exists($route_path)
            ? new RouteResult($route_path, [])
            : false;
    }
}
