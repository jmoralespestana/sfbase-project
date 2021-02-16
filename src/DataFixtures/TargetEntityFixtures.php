<?php

namespace App\DataFixtures;

use App\Entity\TargetEntity;
use Doctrine\Persistence\ObjectManager;

class TargetEntityFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 200; $i++) {
            $object = new TargetEntity();
            $object->setName($this->faker->name);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
