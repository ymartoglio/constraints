<?php
/**
 * Created by PhpStorm.
 * User: yo
 * Date: 15/04/17
 * Time: 03:24
 */

require 'vendor/autoload.php';

use ymartoglio\Constraints\Arr\HasKey;
use PHPUnit\Framework\TestCase;

class HasKeyTest extends TestCase
{
    public function testKeySetsIfNotSatisfied()
    {
        $constraint = new HasKey('offset',0);

        $this->assertFalse($constraint->isSatisfied([]));

        $value = $constraint->apply([]);
        $this->assertArrayHasKey('offset', $value);
        $this->assertEquals($value['offset'], 0);
    }

    public function testIsSatisfiedIfAlreadyHasKey()
    {
        $constraint = new HasKey('limit', 15);
        $this->assertTrue($constraint->isSatisfied(['limit' => 12]));
        $this->assertTrue($constraint->isSatisfied(['limit' => 12, 'offset' => 23]));
    }

    public function testIsNotModifyingValueIfSatisfied()
    {
        $constraint = new HasKey('limit', 15);
        $value = ['limit' => 12, 'offset' => 45];
        $this->assertEquals($constraint->apply($value), ['limit' => 12, 'offset' => 45]);
    }

    public function testHookApply()
    {
        $inputValue = 1000;
        $constraint = new HasKey('limit',$inputValue);

        $value = $constraint->apply([], null, function($value, $reference){
            $maxValue = (new ymartoglio\Constraints\Int\Max(15))->apply($value[$reference]);
            $value[$reference] = $maxValue;
            return $value;
        });

        $this->assertArrayHasKey('limit', $value);
        $this->assertEquals($value['limit'], 15);

        $constraint = new HasKey('offset',30);

        $value = $constraint->apply(['offset' => -12], null, function($value, $reference){
            $minValue = (new ymartoglio\Constraints\Int\Min(0))->apply($value[$reference]);
            $value[$reference] = $minValue;
            return $value;
        });

        $this->assertArrayHasKey('offset', $value);
        $this->assertEquals($value['offset'], 0);
    }
}
