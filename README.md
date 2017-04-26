Constraints
===========

A library to validate variables constraints and apply default if needed.

Example
-------

```php
<?php
use ymartoglio\Constraints\Int\Min;
use ymartoglio\Constraints\Int\Max;
use ymartoglio\Constraints\Collection;

// Reach a minimum

$min = new Min(5);
$min->isSatisfied(4); // returns false
$min->isSatisfied(6); // returns true

$min->apply(5); // returns 5
$min->apply(4); // returns 5
$min->apply(6); // returns 6

// Is in range

$range = new Collection([
    new Min(5),
    new Max(10),
]);

$range->isSatisfied(7); // returns true
$range->isSatisfied(0); // returns false
$range->isSatisfied(11); // returns false

// Has a key

$hasKey = new HasKey('offset',0);

$hasKey->isSatisfied([]); // Returns False

$constraint->apply([]); // Returns ['offset' => 0]
```



