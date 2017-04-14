<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 00:36
 */

namespace Constraints;


abstract class Constraint implements ConstraintInterface
{
    private $valueReference;

    public function __construct($reference)
    {
        $this->valueReference = $reference;
    }

    public function isSatisfied($value)
    {
        return $this->_satisfy($value, $this->valueReference);
    }

    public function apply($value)
    {
        return $this->_apply($value, $this->valueReference);
    }

    abstract protected function _satisfy($value, $constraint);

    abstract protected function _apply($value, $constraint);
}