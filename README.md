Decouplr
=========
Decouplr is a simple abstract adapter class to provide decoupling to dependencies that don't specify their own interfaces.

Installation
------------
Install Decouplr by adding the following to your composer.json file
```js
{
    "require": {
        "divsmith/decouplr": "1.*"
    }
}
```

Usage
-----
1. Create an interface specifying the methods of the concrete dependency you are going to depend on.
```php
interface ExampleInterface {
    public function method1($args);
    public function method2($args);
    etc...
}
```
2. Create an adapter class that extends Decouplr and implements the interface.
```php
class ExampleInterfaceAdapter extends \Decouplr\Decouplr implements ExampleInterface {

    public function method1($args)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

    public function method2($args)
    {
        return $this->delegate(__FUNCTION__, func_get_args());
    }

}
```
Each method needs to contain
```php
return $this->delegate(__FUNCTION__, func_get_args());
```
or it will not behave as expected.
3. Inject the concrete dependency via the adapter constructor. This can either be done by using
the predefined Decouplr constructor
```php
$adapter = new ExampleInterfaceAdapter(new ConcreteDependency());
```
or typehinted and injected via an IoC container
```php
class ExampleInterfaceAdapter extends\Decouplr\Decouplr implements ExampleInterface {

    public function __construct(\Namespace\ConcreteDependency $dependency)
    {
        $this->decoupled = $dependency;
    }

    ...
}
```
4. Enjoy! You can now use the adapter exactly as you would the concrete dependency while enjoying the
flexibility and future proofing of the interface.

