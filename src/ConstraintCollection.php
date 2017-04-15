<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:04
 */

namespace Constraints;


class ConstraintCollection implements ConstraintInterface
{
    protected $_value;
    protected $_lazyCheck;
    protected $_constraints;

    public function __construct(array $constraints = [], bool $lazyCheck = false)
    {
        $this->_constraints = $constraints;
        $this->_lazyCheck = $lazyCheck;
    }

    function isSatisfied($value)
    {
        foreach ($this->_constraints as $constraint) {
            if(!$constraint->isSatisfied($value)) {
                return false;
            }
        }
        return true;
    }

    function apply($value)
    {
        foreach ($this->_constraints as $constraint) {
            $value = $constraint->apply($value);
        }
        return $value;
    }

}