<?php

namespace P\Serialization;

interface ISerializer
{
    /**
     * Serializes a value to a string
     * @param mixed $value
     * @return string
     */
    public function serialize($value);

    /**
     * Convert serialized data into back an object
     * @param string $data
     * @return mixed
     */
    public function deserialize($data);
}
