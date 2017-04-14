<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:06
 */
namespace Constraints;

interface ConstraintInterface
{
    function isSatisfied($value);
    function apply($value);
}