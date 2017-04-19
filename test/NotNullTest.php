<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 00:27
 */

require 'vendor/autoload.php';

use ymartoglio\Constraints\Misc\NotNull;
use PHPUnit\Framework\TestCase;

class NotNullTest extends TestCase
{
    public function testIsSatisfiedIfValueNotNull()
    {
        $constraint = new NotNull(20);
        $this->assertTrue($constraint->isSatisfied(67));
        $this->assertTrue($constraint->isSatisfied('string'));
        $this->assertTrue($constraint->isSatisfied(true));
    }

    public function testIsNotSatisfiedIfValueNull()
    {
        $constraint = new NotNull(20);
        $this->assertFalse($constraint->isSatisfied(null));
    }

    public function testIsThrowingExceptionIfReferenceIsNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $constraint = new NotNull(null);
        $constraint->isSatisfied(20);
    }

    public function testApplyReturnsReferenceIfNull()
    {
        $constraint = new NotNull('string');
        $this->assertEquals('string', $constraint->apply(null));
    }

    public function testApplyReturnsValueIfNotNull()
    {
        $constraint = new NotNull('string');
        $this->assertEquals(20, $constraint->apply(20));
        $this->assertEquals(true, $constraint->apply(true));
    }
}
