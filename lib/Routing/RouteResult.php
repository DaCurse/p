<?php

namespace P\Routing;

/**
 * Contains information about a requested route
 */
class RouteResult
{
    /** @var string */
    public $route_path;
    /** @var string[] */
    public $params;

    /**
     * @param string $route_path
     * @param string[] $params
     */
    public function __construct($route_path, $params)
    {
        $this->route_path = $route_path;
        $this->params = $params;
    }
}
