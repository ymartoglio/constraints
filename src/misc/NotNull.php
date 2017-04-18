<?php
/**
 * User: ymartoglio
 * Date: 14/04/17
 * Time: 23:11
 */

namespace ymartoglio\Constraints\Misc;

use ymartoglio\Constraints\Constraint;

class NotNull extends Constraint
{
    /**
     * @param mixed $value
     * @param mixed $constraint
     * @throws \InvalidArgumentException
     * @return bool
     */
    protected function _satisfy($value, $constraint)
    {
        if(is_null($constraint)) {
            throw new \InvalidArgumentException("constraint cannot be null");
        }

        return !is_null($value);
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