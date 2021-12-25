<?php

namespace Framework\Caching;

class CacheRecord
{
    /** @var mixed */
    public $data;
    /** @var float */
    public $expires_in;

    /**
     * @param mixed $data
     * @param float $expires_in
     */
    public function __construct($data, $expires_in)
    {
        $this->data = $data;
        $this->expires_in = $expires_in;
    }
}
