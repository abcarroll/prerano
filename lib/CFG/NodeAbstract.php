<?php

namespace Prerano\CFG;

abstract class NodeAbstract implements Node
{
    protected $attributes;

    /**
     * Creates a Node.
     *
     * @param array $attributes Array of attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->attributes = $attributes;
    }

    /**
     * Gets the type of the node.
     *
     * @return string Type of the node
     */
    public function getName(): string
    {
        return strtr(substr(rtrim(get_class($this), '_'), strlen(__NAMESPACE__) + 6), '\\', '_');
    }

    /**
     * Gets line the node started in.
     *
     * @return int Line
     */
    public function getLine(): int
    {
        return $this->getAttribute('startLine', -1);
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    public function &getAttribute($key, $default = null)
    {
        if (!array_key_exists($key, $this->attributes)) {
            return $default;
        } else {
            return $this->attributes[$key];
        }
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function jsonSerialize()
    {
        return ['nodeType' => $this->getType()] + get_object_vars($this);
    }
}
