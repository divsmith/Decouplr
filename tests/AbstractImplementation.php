<?php namespace Decouplr\Tests\Fixtures;

class AbstractImplementation extends \Decouplr\Decouplr implements AbstractInterface {

    public function __construct($dependency)
    {
        $this->dependency = $dependency;
    }

    public function doStuff($arg1, $arg2)
    {
        return $this->dependency->doStuff($arg1, $arg2);
    }

}