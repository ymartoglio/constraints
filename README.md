Contraints
==========

A libray to Validate variables constraints and apply default if needed.

Example
-------

```php
$min = new MinConstraint(5);
$min->isSatisfied(4); // returns false
$min->isSatisfied(6); // returns true

$min->apply(5); // returns 5
$min->apply(4); // returns 5
$min->apply(6); // returns 6


$interval = new ConstraintCollection([
    new MinConstraint(5),
    new MaxConstraint(10),
]);

$interval->isSatisfied(7); // returns true
$interval->isSatisfied(0); // returns false
$interval->isSatisfied(11); // returns false

```

```php
$hasKey = new HasKeyConstraint('offset',0);

$hasKey->isSatisfied([]); // Returns False

$constraint->apply([]); // Returns ['offset' => 0]
```



