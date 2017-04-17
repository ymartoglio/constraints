<?php
/**
 * User: ymartoglio
 * Date: 15/04/17
 * Time: 03:15
 */

namespace Constraints;


/**
 * Class HasKeyConstraint
 * @package Constraints
 */
class HasKeyConstraint extends Constraint
{

    private $_default;

    public function __construct($reference, $default)
    {
        parent::__construct($reference);
        $this->_default = $default;
    }

    protected function _satisfy($value, $constraint)
    {
        if(!is_array($value)) {
            throw new \InvalidArgumentException("value must be an array");
        }

        if(is_null($constraint) || !is_string($constraint)) {
            throw new \InvalidArgumentException("constraint cannot be null");
        }

        return array_key_exists($constraint, $value);
    }

    /**
     * @param $value
     * @param $constraint
     */
    protected function _apply($value, $constraint)
    {
        if(!$this->_satisfy($value, $constraint)) {
            $value[$constraint] = $this->_default;
        }

        return $value;
    }
}