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

4. Enjoy! You can now typehint the interface and inject the adapter instead of the concrete dependency
    (assuming appropriate IoC bindings). Use the adapter exactly as you would the concrete dependency and
    sleep better at night knowing that your code is decoupled from it.
    
Other Usage
-----------
You can use Decouplr with empty interfaces that simply provide latches for your IoC container to resolve. 
Just inject your concrete dependency into your adapter and let Decouplr do the rest. Not as architecturally
sound as a well defined interface, but it gets you the benefits of not being tied to the concrete dependency 
while not requiring you to define each method in the adapter.
```php
interface ExampleInterface {};

class ExampleAdapter extends \Decouplr\Decouplr implements ExampleInterface{
    
    public function __construct(\Namespace\ConcreteDependency $dependency)
    {
        $this->decoupled = $dependency;
    }
}
```
