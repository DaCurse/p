<?php

namespace Framework\Routing;

use ArrayIterator;

class ParamRoute
{
    /** @var string */
    public $route_path;
    /** @var string[] */
    public $route_parts;

    /**
     * @param string $route_path
     * @param string[] $route_parts
     */
    public function __construct($route_path, $route_parts)
    {
        $this->route_path = $route_path;
        $this->route_parts = $route_parts;
    }

    /**
     * @param string $route_path
     * @return false|string[]
     */
    public static function parse_path($route_path)
    {
        $ext_pos = strrpos($route_path, '.');
        $normalized_path = str_replace(
            '.' . ROUTE_PARAM_PREFIX,
            '/' . ROUTE_PARAM_PREFIX,
            substr($route_path, 0, $ext_pos)
        );
        $route_parts = explode('/', $normalized_path);
        $params = array_filter($route_parts, function ($part) {
            return strpos($part, ROUTE_PARAM_PREFIX) === 0;
        });
        return empty($params) ? false : $route_parts;
    }

    /**
     * @param string $request_path
     * @return false|string[]
     */
    public function match($request_path)
    {
        $request_parts = explode('/', $request_path);
        if (count($request_parts) !== count($this->route_parts)) return false;

        $param_values = [];
        $it = new ArrayIterator($this->route_parts);
        for (; $it->valid(); $it->next()) {
            if (strpos($it->current(), ROUTE_PARAM_PREFIX) === 0) {
                $param_name = substr($it->current(), strlen(ROUTE_PARAM_PREFIX));
                $param_values[$param_name] = $request_parts[$it->key()];
            }
        }

        return $param_values;
    }
}
