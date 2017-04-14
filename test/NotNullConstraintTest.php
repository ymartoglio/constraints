<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 00:27
 */

require 'vendor/autoload.php';

use Constraints\NotNullConstraint;
use PHPUnit\Framework\TestCase;

class NotNullConstraintTest extends TestCase
{
    public function testIsSatisfiedIfValueNotNull()
    {
        $constraint = new NotNullConstraint(20);
        $this->assertTrue($constraint->isSatisfied(67));
        $this->assertTrue($constraint->isSatisfied('string'));
        $this->assertTrue($constraint->isSatisfied(true));
    }

    public function testIsNotSatisfiedIfValueNull()
    {
        $constraint = new NotNullConstraint(20);
        $this->assertFalse($constraint->isSatisfied(null));
    }

    public function testIsThrowingExceptionIfReferenceIsNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new NotNullConstraint(null);
        $constraint->isSatisfied(20);
    }

    public function testApplyReturnsReferenceIfNull()
    {
        $constraint = new NotNullConstraint('string');
        $this->assertEquals('string', $constraint->apply(null));
    }

    public function testApplyReturnsValueIfNotNull()
    {
        $constraint = new NotNullConstraint('string');
        $this->assertEquals(20, $constraint->apply(20));
        $this->assertEquals(true, $constraint->apply(true));
    }
}
