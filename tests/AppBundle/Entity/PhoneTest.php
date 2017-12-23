<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 28/09/2017
 * Time: 17:42
 */

namespace Test\Entity;

use AppBundle\Entity\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testGettersSetters()
    {

        // r_ for real objects
        // m_ for mockup objects
        $r_Phone = new Phone();

        $methodTests = array(
            'Name' => 'Jojo',
            'Brand' => 'Jayjay',
            'Serial' => '498dza',
            'Description' => 'What the hell is it ? 666 ?',
            'Os' => 'Android',
            'ScreenSize' => 9,
            'ScreenWidth' => 210,
            'ScreenHeight' => 650
        );

        // Testing getters and setters
        foreach ($methodTests as $key => $value)
        {
            $setMethod = 'set' . $key;
            $getMethod = 'get' . $key;
            $r_Phone->$setMethod($value);
            $this->assertEquals($value, $r_Phone->$getMethod());
        }

    }
}