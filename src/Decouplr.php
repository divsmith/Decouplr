<?php namespace Decouplr; 

abstract class Decouplr {

    private $dependency;

    public function __construct($dependency)
    {
        $this->dependency = $dependency;
    }

    public function __call($method, $arguments)
    {
        if( method_exists($this->dependency, $method) )
        {
            return $this->dependency->$method($arguments);
        }
    }

} 