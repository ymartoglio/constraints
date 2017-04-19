<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 03:43
 */

use ymartoglio\Constraints\Collection;
use ymartoglio\Constraints\Int\Min;
use ymartoglio\Constraints\Int\Max;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testMultiSatisfactionConstraintOK()
    {
        $collection = new Collection([
            new Max(10),
            new Min(3)
        ]);

        $this->assertTrue($collection->isSatisfied(3));
        $this->assertTrue($collection->isSatisfied(4));
        $this->assertTrue($collection->isSatisfied(8));
        $this->assertTrue($collection->isSatisfied(9));
        $this->assertTrue($collection->isSatisfied(10));
    }

    public function testMultiSatisfactionConstraintNOK()
    {
        $collection = new Collection([
            new Max(-50),
            new Min(-100)
        ]);

        $this->assertFalse($collection->isSatisfied(-49));
        $this->assertFalse($collection->isSatisfied(-101));
        $this->assertFalse($collection->isSatisfied(56));
    }

    public function testMultiApplyConstraintInterval()
    {
        $collection = new Collection([
            new Max(10),
            new Min(0)
        ]);

        $this->assertEquals($collection->apply(-10), 0);
        $this->assertEquals($collection->apply(50), 10);
        $this->assertEquals($collection->apply(7), 7);
    }

    public function testCollectionIfCollection(){

        $collection1 = new Collection( [
            new Max(10),
            new Min(0)
        ]);

        $collection2 = new Collection( [
            new Max(7),
            new Min(3)
        ]);

        $collection3 = new Collection( [
            new Max(6),
            new Min(4)
        ]);

        $super = new Collection([
            $collection1,
            $collection2,
            $collection3
        ]);

        $this->assertTrue($super->isSatisfied(5));
    }
}
