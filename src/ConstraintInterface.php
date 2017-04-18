<?php
/**
 * User: ymartoglio
 * Date: 14/04/17
 * Time: 23:06
 */
namespace ymartoglio\Constraints;

interface ConstraintInterface
{
    /**
     * Tells if the constraint is satisfied for the given $value.
     * @param $value
     * @return mixed
     */
    function isSatisfied($value);

    /**
     * Applies the constraint on the given value.
     * Accepts before and after hooks.
     * @param $value
     * @param null $hookBefore
     * @param null $hookAfter
     * @return mixed
     */
    function apply($value, $hookBefore = null, $hookAfter = null);
}