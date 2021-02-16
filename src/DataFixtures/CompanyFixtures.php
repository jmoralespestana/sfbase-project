<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $object = new Company();
            $object->setName($this->faker->company);

            $this->addReference('COMPANY'.$i,$object);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
