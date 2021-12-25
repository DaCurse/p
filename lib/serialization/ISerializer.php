<?php

namespace P\Serialization;

interface ISerializer
{
    /**
     * @param mixed $value
     * @return string
     */
    public function serialize($value);

    /**
     * @param string $data
     * @return mixed
     */
    public function deserialize($data);
}
