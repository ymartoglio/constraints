<?php
/**
 * User: ymartoglio
 * Date: 15/04/17
 * Time: 00:36
 */

namespace Constraints;

/**
 * Class Constraint
 * @package Constraints
 */
abstract class Constraint implements ConstraintInterface
{
    /**
     * @var mixed $valueReference
     */
    protected $valueReference;

    /**
     * Constraint constructor. Saves $reference in $this->valueReference.
     * @param $reference
     */
    public function __construct($reference)
    {
        $this->valueReference = $reference;
    }

    /**
     * Returns the result of instance::_satisfy().
     * Result may vary, depending id the constraint type.
     * @param $value
     * @return mixed
     */
    public function isSatisfied($value)
    {
        return $this->_satisfy($value, $this->valueReference);
    }

    /**
     * Applies the constraint in case of unsatisfying input.
     * @param $value
     * @param null $hookBefore
     * @param null $hookAfter
     * @return mixed
     */
    public function apply($value, $hookBefore = null, $hookAfter = null)
    {
        $value         = $this->hookBeforeApply($value, $hookBefore);
        $returnedValue = $this->_apply($value, $this->valueReference);
        $returnedValue = $this->hookAfterApply($returnedValue, $hookAfter);

        return $returnedValue;
    }

    /**
     * Provides the hookBefore() given in apply call.
     * The method gets the value on which the constraint is applied.
     * Must return a modified value of the input type. A test of types is performed.
     * @param $value
     * @param null $hookBefore
     * @return mixed
     */
    private function hookBeforeApply($value, $hookBefore = null)
    {
        if(is_null($hookBefore)) {
            return $value;
        }

        if(!is_callable($hookBefore)) {
            throw new \InvalidArgumentException('$hookBefore must be a callable');
        }

        $valueType     = gettype($value);
        $modifiedValue = $hookBefore($value, $this->valueReference);
        $modifiedType  = gettype($modifiedValue);

        if($valueType == $modifiedType) {
            return $modifiedValue;
        } else {
            throw new \InvalidArgumentException("Input and output type must be equal : input type" . $valueType . ', output type : ' . $modifiedType);
        }
    }

    /**
     * Provides the hookAfter() given in apply call.
     * The method gets the value on which the constraint has been applied.
     * Must return a modified value of the input type. A test of types is performed.
     * @param $returnedValue
     * @param null $hookAfter
     * @return mixed
     */
    private function hookAfterApply($returnedValue, $hookAfter = null)
    {
        if(is_null($hookAfter)) {
            return $returnedValue;
        }

        if(!is_callable($hookAfter)) {
            throw new \InvalidArgumentException('$hookAfter must be a callable');
        }

        $valueType     = gettype($returnedValue);
        $modifiedValue = $hookAfter($returnedValue, $this->valueReference);
        $modifiedType  = gettype($modifiedValue);

        if($valueType == $modifiedType) {
            return $modifiedValue;
        } else {
            throw new \InvalidArgumentException("Input and output type must be equal : input type" . $valueType . ', output type : ' . $modifiedType);
        }
    }

    /**
     * Defines the test on which the constraint is based.
     * @param $value
     * @param $constraint
     * @return boolean
     */
    abstract protected function _satisfy($value, $constraint);

    /**
     * Applies the modification imposed by the constraint.
     * @param $value
     * @param $constraint
     * @return boolean
     */
    abstract protected function _apply($value, $constraint);
}