<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 09/01/2018
 * Time: 15:46
 */

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;

class CompanyFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $companies = Yaml::parse(file_get_contents(dirname(__DIR__) . '/DataFixtures/definitions/companies.yaml'));

        foreach ($companies as $key => $value)
        {
            $company = new Company();

            $company->setUsername($key);
            $company->setEmail($value['email']);
            $company->setPassword(
                $this->encoder->encodePassword($company, $value['password'])
            );

            $this->addReference($key, $company);

            $manager->persist($company);
        }

        $manager->flush();
    }
}