<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 09/01/2018
 * Time: 15:46
 */

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class CustomerFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $customers = Yaml::parse(file_get_contents(dirname(__DIR__) . '/DataFixtures/definitions/customers.yaml'));

        foreach ($customers as $key => $value)
        {
            $customer = new Customer();
            $company = $this->getReference($value['company']);

            $customer->setFirstName($value['firstName']);
            $customer->setLastName($value['lastName']);
            $customer->setAddress($value['address']);
            $customer->setPhoneNumber($value['phoneNumber']);

            // Managing relation Company->Customer
            $company->addCustomer($customer);

            $manager->persist($customer);
            $manager->persist($company);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(CompanyFixture::class);
    }
}