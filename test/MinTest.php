<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:45
 */
require 'vendor/autoload.php';

use ymartoglio\Constraints\Int\Min;
use PHPUnit\Framework\TestCase;

final class MinTest extends TestCase
{
    public function testIsSatisfiedIfSuperior()
    {
        $constraint = new Min(10);

        $this->assertTrue($constraint->isSatisfied(11));
        $this->assertTrue($constraint->isSatisfied(10.0001));
        $this->assertTrue($constraint->isSatisfied(876));
    }

    public function testIsSatisfiedIfEqual()
    {
        $constraint = new Min(12);

        $this->assertTrue($constraint->isSatisfied(12));
    }

    public function testIsNotSatisfiedIfInferior()
    {
        $constraint = new Min(1539);

        $this->assertFalse($constraint->isSatisfied(123));
        $this->assertFalse($constraint->isSatisfied(677));
        $this->assertFalse($constraint->isSatisfied(976));
        $this->assertFalse($constraint->isSatisfied(-54));
    }

    public function testIsThrowingExceptionIfWrongType_String()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Min(6);
        $constraint->isSatisfied('a string instead of a numeric type');
    }

    public function testIsThrowingExceptionIfWrongType_Boolean()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Min(6);
        $constraint->isSatisfied(true);
    }

    public function testIsThrowingExceptionIfWrongType_Null()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Min(6);
        $constraint->isSatisfied(null);
    }

    public function testApplyValueIfSatisfied()
    {
        $value = 12.6; $ref = 12;
        $constraint = new Min($ref);
        $this->assertEquals($value, $constraint->apply($value));
    }

    public function testApplyConstraintIfNotSatisfied()
    {
        $value = -7; $ref = 12;
        $constraint = new Min($ref);
        $this->assertEquals($ref, $constraint->apply($value));
    }
}
