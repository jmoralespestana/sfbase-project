<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends AppFixtures implements DependentFixtureInterface
{
    private $encodePassword;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();
        $this->encodePassword = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $object = new User();
        $object->setUsername('apiplatform')
        ->setCompany($this->getReference('COMPANY0'))
            ->setPassword($this->encodePassword->encodePassword($object,'p@ssw0rd'));

        for ($i = 0; $i < 5; $i++) {
            $object->addSecurityGroup($this->getReference('SECURITY_GROUP' . $i));
        }

        $manager->persist($object);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @psalm-return array<class-string<FixtureInterface>>
     */
    public function getDependencies()
    {
        return [CompanyFixtures::class,SecurityGroupFixtures::class];
    }
}
