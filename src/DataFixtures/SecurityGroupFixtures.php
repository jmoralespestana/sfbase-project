<?php

namespace App\DataFixtures;

use App\Entity\SecurityGroup;
use Doctrine\Persistence\ObjectManager;

class SecurityGroupFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        $levels = ['_BLACK','_GOLD','_VIP','_PLATINUM'];

        for ($i = 0; $i < 5; $i++) {
            $object = new SecurityGroup();
            $object->setDescription('SECURITY_GROUP' . $i)
                ->setCompany($this->getReference('COMPANY0'));

            $permissions = [];

            for ($j = 0; $j < random_int(5,15); $j++) {
                $permissions[] = 'ROLE_MODULE' . random_int(0,4) . $levels[random_int(0,3)];
            }

            $object->setPermissions($permissions);

            $this->addReference('SECURITY_GROUP' . $i, $object);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
