<?php namespace Divsmith\Airlock;

abstract class Airlock {

    protected $locker;

    public function __construct($dependency)
    {
        $this->locker = $dependency;
    }

    public function delegate($method, $args)
    {
        return $this->__call($method, $args);
    }

    public function __call($method, $args)
    {
        if( is_callable([$this->locker, $method]) )
        {
            return call_user_func_array([$this->locker, $method], $args);
        }

        throw new \BadMethodCallException();
    }
}