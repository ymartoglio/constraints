<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 03:24
 */

require 'vendor/autoload.php';

use Constraints\HasKeyConstraint;
use PHPUnit\Framework\TestCase;

class HasKeyConstraintTest extends TestCase
{
    public function testKeySetsIfNotSatisfied()
    {
        $constraint = new HasKeyConstraint('offset',0);

        $this->assertFalse($constraint->isSatisfied([]));

        $value = $constraint->apply([]);
        $this->assertArrayHasKey('offset', $value);
        $this->assertEquals($value['offset'], 0);
    }

    public function testIsSatisfiedIfAlreadyHasKey()
    {
        $constraint = new HasKeyConstraint('limit', 15);
        $this->assertTrue($constraint->isSatisfied(['limit' => 12]));
        $this->assertTrue($constraint->isSatisfied(['limit' => 12, 'offset' => 23]));
    }

    public function testIsNotModifyingValueIfAlreadySatisfied()
    {
        $constraint = new HasKeyConstraint('limit', 15);
        $value = ['limit' => 12, 'offset' => 45];
        $this->assertEquals($constraint->apply($value), ['limit' => 12, 'offset' => 45]);
    }
}