<?php namespace Decouplr; 

abstract class Decouplr {

    protected $decoupled;

    public function __construct($dependency)
    {
        $this->decoupled = $dependency;
    }

    public function __call($method, $args)
    {
        if( is_callable([$this->decoupled, $method]) )
        {
            return call_user_func_array([$this->decoupled, $method], $args);
        }

        throw new \BadMethodCallException();
    }
}