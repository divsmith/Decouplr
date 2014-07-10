<?php namespace Decouplr; 

abstract class Decouplr {

    protected $dependency;

    public function __construct($dependency)
    {
        $this->dependency = $dependency;
    }

    public function __call($method, $args)
    {
        if( is_callable([$this->dependency, $method]) )
        {
            return call_user_func_array([$this->dependency, $method], $args);
        }

        throw new \BadMethodCallException();
    }
}