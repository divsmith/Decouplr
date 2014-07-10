<?php namespace Decouplr\Tests;

use \Mockery;
use \Decouplr\Tests\Fixtures\ConcreteClass;
use \Decouplr\Tests\Fixtures\AbstractImplementation;

class DecouplrTest extends \PHPUnit_Framework_TestCase {

    protected function tearDown()
    {
        Mockery::close();
    }
    public function createAdapter($dependency)
    {
        return new AbstractImplementation($dependency);
    }

    /** @test */
    public function method_calls_are_delegated()
    {
        $dependency = Mockery::mock('ConcreteClass');
        $dependency->shouldReceive('doStuff')
                ->with(1, 2)
                ->once();

        $adapter = $this->createAdapter($dependency);
        $adapter->doStuff(1, 2);
    }

    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function bad_method_calls_throw_exception()
    {
        $dependency = new ConcreteClass();

        $adapter = $this->createAdapter($dependency);
        $adapter->doOtherStuff(1, 2);
    }

    /**
     * @test
     */
    public function values_are_returned_correctly()
    {
        $dependency = new ConcreteClass();

        $adapter = $this->createAdapter($dependency);
        $this->assertEquals(3, $adapter->add(1, 2));
    }
} 