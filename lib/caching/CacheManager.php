<?php

namespace Framework\Caching;


class CacheManager
{
    /** @var string */
    private $cache_path;
    private $serializer;
    /** @var bool */
    private $should_update;
    /** @var CacheRecord[] */
    private $cache;

    public function __construct($cache_path, $serializer)
    {
        $this->cache_path = $cache_path;
        $this->serializer = $serializer;
        $this->should_update = false;
        $this->cache = file_exists($this->cache_path) ? $this->load_cache() : [];
    }

    public function __destruct()
    {
        if (!$this->should_update) return;
        file_put_contents($this->cache_path, $this->serializer->serialize($this->cache));
    }

    /**
     * @param string $name
     * @return false|mixed
     */
    public function get($name)
    {
        if (!isset($this->cache[$name])) return false;
        return $this->cache[$name]->data;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param float $ttl
     * @return void
     */
    public function set($name, $value, $ttl = CACHE_DEFAULT_TTL)
    {
        $this->cache[$name] = new CacheRecord($value, microtime(true) + $ttl);
        $this->should_update = true;
    }

    public function clear()
    {
        $this->cache = [];
        $this->should_update = true;
    }

    private function load_cache()
    {
        $cache = (array)$this->serializer->deserialize(file_get_contents($this->cache_path));
        return array_filter($cache, function ($record) {
            return (
                get_class($record) !== '__PHP_Incomplete_Class' &&
                $record->expires_in > microtime(true)
            );
        });
    }
}


