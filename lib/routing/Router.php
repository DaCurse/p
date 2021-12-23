<?php

namespace Framework\Routing;

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
     * @param $request_path
     * @return RouteResult
     */
    public function get_route($request_path)
    {

    }
}
