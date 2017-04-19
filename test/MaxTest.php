<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 14/04/17
 * Time: 23:45
 */
require 'vendor/autoload.php';

use ymartoglio\Constraints\Int\Max;
use PHPUnit\Framework\TestCase;

final class MaxTest extends TestCase
{
    public function testIsSatisfiedIfInferior()
    {
        $constraint = new Max(10);

        $this->assertTrue($constraint->isSatisfied(9));
        $this->assertTrue($constraint->isSatisfied(5.2));
        $this->assertTrue($constraint->isSatisfied(0));
        $this->assertTrue($constraint->isSatisfied(-1));
        $this->assertTrue($constraint->isSatisfied(-13.5));
    }

    public function testIsSatisfiedIfEqual()
    {
        $constraint = new Max(12);

        $this->assertTrue($constraint->isSatisfied(12));
    }

    public function testIsNotSatisfiedIfSuperior()
    {
        $constraint = new Max(1539);

        $this->assertFalse($constraint->isSatisfied(12390));
        $this->assertFalse($constraint->isSatisfied(84677));
        $this->assertFalse($constraint->isSatisfied(10976));
        $this->assertFalse($constraint->isSatisfied(14678));
    }

    public function testIsThrowingExceptionIfWrongType_String()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Max(6);
        $constraint->isSatisfied('a string instead of a numeric type');
    }

    public function testIsThrowingExceptionIfWrongType_Boolean()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Max(6);
        $constraint->isSatisfied(true);
    }

    public function testIsThrowingExceptionIfWrongType_Null()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new Max(6);
        $constraint->isSatisfied(null);
    }

    public function testApplyValueIfSatisfied()
    {
        $value = 10; $ref = 12;
        $constraint = new Max($ref);
        $this->assertEquals($value, $constraint->apply($value));
    }

    public function testApplyConstraintIfNotSatisfied()
    {
        $value = 15; $ref = 12;
        $constraint = new Max($ref);
        $this->assertEquals($ref, $constraint->apply($value));
    }
}
