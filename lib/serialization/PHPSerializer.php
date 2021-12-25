<?php

namespace P\Serialization;

class PHPSerializer implements ISerializer
{
    /**
     * @inheritDoc
     */
    public function serialize($value)
    {
        return serialize($value);
    }

    /**
     * @inheritDoc
     */
    public function deserialize($data)
    {
        return unserialize($data);
    }
}
