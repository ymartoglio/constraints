<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 03:43
 */

use Constraints\ConstraintCollection;
use Constraints\MinConstraint;
use Constraints\MaxConstraint;
use PHPUnit\Framework\TestCase;

class ConstraintCollectionTest extends TestCase
{
    public function testMultiSatisfactionConstraintOK()
    {
        $collection = new ConstraintCollection([
            new MaxConstraint(10),
            new MinConstraint(3)
        ]);

        $this->assertTrue($collection->isSatisfied(3));
        $this->assertTrue($collection->isSatisfied(4));
        $this->assertTrue($collection->isSatisfied(8));
        $this->assertTrue($collection->isSatisfied(9));
        $this->assertTrue($collection->isSatisfied(10));
    }

    public function testMultiSatisfactionConstraintNOK()
    {
        $collection = new ConstraintCollection([
            new MaxConstraint(-50),
            new MinConstraint(-100)
        ]);

        $this->assertFalse($collection->isSatisfied(-49));
        $this->assertFalse($collection->isSatisfied(-101));
        $this->assertFalse($collection->isSatisfied(56));
    }
}
