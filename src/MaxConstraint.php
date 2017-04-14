<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:11
 */

namespace Constraints;


class MaxConstraint extends Constraint
{
    /**
     * @param mixed $value
     * @param mixed $constraint
     * @throws \InvalidArgumentException
     * @return bool
     */
    protected function _satisfy($value, $constraint)
    {
        if(!is_numeric($value)) {
            throw new \InvalidArgumentException("value must be a numeric type");
        }

        if(!is_numeric($constraint)) {
            throw new \InvalidArgumentException("constraint must be a numeric type");
        }

        return $value <= $constraint;
    }

    /**
     * @param mixed $value
     * @param mixed $constraint
     * @throws \InvalidArgumentException
     * @return mixed
     */
    protected function _apply($value, $constraint)
    {
        return $this->_satisfy($value, $constraint) ? $value : $constraint;
    }
}