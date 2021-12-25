<?php

namespace P\Serialization;

/**
 * Serializer implementation that uses PHP's basic serialization
 */
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
