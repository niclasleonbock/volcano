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
echo Volcano::implode(function ($piece, $count) use ($pieces) {
    return ($count == count($pieces)-2 ? ' and ' : ', ');
}, $pieces) . ' like it!';

// string as glue
echo 'These people like it: ' . Volcano::implode(', ', $pieces);

// reverse
print_r(Volcano::explode(', ', Volcano::implode(', ', $pieces)));
```