<?php
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 06.09.18
 * Time: 15:32
 */

use EloquentUsefulness\Traits\HasImplodableAttribute;
use PHPUnit\Framework\TestCase;

class TraitClassTest extends TestCase
{

    private $hasExplodeTrait;

    public function setUp()
    {
        $this->hasExplodeTrait = $this->getObjectForTrait(HasImplodableAttribute::class);
    }

    /**
     * @dataProvider provider
     */
    public function testAttributeExplosion($sting, $expect)
    {

        $this->assertEquals(
            $expect,
            $this->getMethodReflection('getListedAttribute')->invoke($this->hasExplodeTrait, $sting)
        );
    }

    public function provider()
    {
        return [
            ['1|2|3', [1, 2, 3]],
            ['1', [1]],
            ['', []],
            [null, []],
        ];
    }

    private function getMethodReflection($method)
    {
        $getTraitGetListedMethod = new ReflectionMethod(
            get_class($this->hasExplodeTrait),
            $method
        );
        $getTraitGetListedMethod->setAccessible(true);
        return $getTraitGetListedMethod;
    }


}