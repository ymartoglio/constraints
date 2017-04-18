<?php
/**
 * User: ymartoglio
 * Date: 14/04/17
 * Time: 23:04
 */

namespace ymartoglio\Constraints;


class Collection implements ConstraintInterface
{
    protected $_value;
    protected $_lazyCheck;
    protected $_constraints;

    public function __construct(array $constraints = [], $lazyCheck = false)
    {
        $this->_constraints = $constraints;
        $this->_lazyCheck = $lazyCheck;
    }

    public function isSatisfied($value)
    {
        foreach ($this->_constraints as $constraint) {
            if(!$constraint->isSatisfied($value)) {
                return false;
            }
        }
        return true;
    }

    public function apply($value, $hookBefore = null, $hookAfter = null)
    {
        foreach ($this->_constraints as $constraint) {
            $value = $constraint->apply($value, $hookBefore = null, $hookAfter = null);
        }
        return $value;
    }
}