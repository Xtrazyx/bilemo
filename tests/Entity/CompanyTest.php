<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 28/09/2017
 * Time: 17:42
 */

namespace Tests\Entity;

use App\Entity\Company;
use App\Entity\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testGettersSetters()
    {

        // r_ for real objects
        // m_ for mockup objects
        $r_Company = new Company();
        $m_Customer = $this->createMock(Customer::class);

        $methodTests = array(
            'Username' => 'Jojo',
            'Password' => 'Asticot',
            'Email' => 'jojo@asticot.fr',
            'Customers' => new ArrayCollection(array($m_Customer))
        );

        // Testing getters and setters
        foreach ($methodTests as $key => $value)
        {
            $setMethod = 'set' . $key;
            $getMethod = 'get' . $key;
            $r_Company->$setMethod($value);
            $this->assertEquals($value, $r_Company->$getMethod());
        }

    }
}
