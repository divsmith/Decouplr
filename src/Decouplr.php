<?php namespace Divsmith\Decouplr;

abstract class Decouplr {

    protected $decoupled;

    public function __construct($dependency)
    {
        $this->decoupled = $dependency;
    }

    public function delegate($method, $args)
    {
        return $this->__call($method, $args);
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