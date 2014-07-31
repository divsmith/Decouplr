<?php namespace Divsmith\Airlock\Tests\Fixtures;

use Divsmith\Airlock\Airlock;

class AbstractImplementation extends Airlock implements AbstractInterface {

    public function add($arg1, $arg2)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

    public function doStuff($arg1, $arg2)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

}