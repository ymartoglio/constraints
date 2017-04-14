<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:04
 */

namespace Constraints;


class ConstraintCollection
{
    protected $_value;
    protected $_lazyCheck;
    protected $_constraints;

    public function __construct($value, array $constraints = [], bool $lazyCheck = true)
    {
        $this->_value = $value;
        $this->_constraints = $constraints;
        $this->_lazyCheck = $lazyCheck;
    }

    public function isSatisfied()
    {

    }
}