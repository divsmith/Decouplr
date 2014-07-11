<?php namespace Decouplr\Tests\Fixtures;

class AbstractImplementation extends \Decouplr\Decouplr implements AbstractInterface {

    public function add($arg1, $arg2)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

    public function doStuff($arg1, $arg2)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

}