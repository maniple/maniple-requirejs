<?php

/**
 * @internal
 */
class ManipleRequirejs_Util_StringCallback
{
    /**
     * @var callable
     */
    protected $_callback;

    /**
     * @param callable $callback
     */
    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('Invalid callback provided');
        }
        $this->_callback = $callback;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $callback = $this->_callback;
        return (string) $callback();
    }
}
