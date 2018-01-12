<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 09/01/2018
 * Time: 15:46
 */

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;

class PhoneFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $phones = Yaml::parse(file_get_contents(dirname(__DIR__) . '/DataFixtures/definitions/phones.yaml'));

        // Hydrating objects via method naming
        foreach ($phones as $key => $methods)
        {
            $phone = new Phone();

            foreach ($methods as $method => $value){
                $setMethod = 'set' . ucfirst($method);

                if(method_exists($phone, $setMethod)){
                    $phone->$setMethod($value);
                }else{
                    throw new \Exception("Le champ <" . $method . "> ne se trouve pas dans " . Phone::class);
                }
            }

            $manager->persist($phone);
        }

        $manager->flush();
    }
}