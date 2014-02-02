Volcano
=======

An approach for making implode and explode in PHP more dynamic. And fun.


How to use
=========

```php
<?php
include __DIR__ . '/vendor/autoload.php';

use niclasleonbock\Volcano\Volcano;

$pieces = ['Walter White', 'Skyler White', 'Jesse Pinkman', 'Hank Schrader'];

// callable as glue
echo Volcano::implode(function ($piece, $key, $count, $pieces) use ($pieces) {
    return ($count == count($pieces)-1 ? ' and ' : ', ');
}, $pieces) . ' like it!';

// string as glue
echo 'These people like it: ' . Volcano::implode(', ', $pieces);

// reverse
print_r(Volcano::explode(', ', Volcano::implode(', ', $pieces)));

// iterable class
class Test implements IteratorAggregate
{
    public $person1 = 'Walter White';
    public $person2 = 'Skyler White';
    public $person3 = 'Jesse Pinkman';

    public function __construct()
    {
        $this->person4 = 'Hank Schrader';
    }

    public function getIterator()
    {
        return new ArrayIterator($this);
    }
}

$class = new Test();

echo 'These people like it: ' . Volcano::implode(', ', $class);

// or
echo Volcano::implode(function ($piece, $key, $count, $pieces) {
    return ($count == iterator_count($pieces)-1 ? ' and ' : ', ');
}, $class) . ' like it!';

```
