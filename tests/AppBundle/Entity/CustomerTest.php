<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 28/09/2017
 * Time: 17:42
 */

namespace Test\Entity;

use AppBundle\Entity\Company;
use AppBundle\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testGettersSetters()
    {

        // r_ for real objects
        // m_ for mockup objects
        $r_Customer = new Customer();
        $m_Company = $this->createMock(Company::class);

        $methodTests = array(
            'FirstName' => 'Jojo',
            'LastName' => 'Asticot',
            'Address' => 'rue du pont',
            'PhoneNumber' => '125',
            'Company' => $m_Company
        );

        // Testing getters and setters
        foreach ($methodTests as $key => $value)
        {
            $setMethod = 'set' . $key;
            $getMethod = 'get' . $key;
            $r_Customer->$setMethod($value);
            $this->assertEquals($value, $r_Customer->$getMethod());
        }

    }
}