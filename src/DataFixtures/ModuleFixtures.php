<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $object = new Module();
            $object->setDescription('APP_MODULE' . $i);

            $permissions = [];

            $permissions[] = 'ROLE_MODULE' . $i . '_BLACK';
            $permissions[] = 'ROLE_MODULE' . $i . '_GOLD';
            $permissions[] = 'ROLE_MODULE' . $i . '_VIP';
            $permissions[] = 'ROLE_MODULE' . $i . '_PLATINUM';

            $object->setPermissions($permissions);

            $this->addReference('APP_MODULE' . $i, $object);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
