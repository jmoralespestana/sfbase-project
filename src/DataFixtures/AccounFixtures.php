<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccounFixtures extends AppFixtures
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $object = new Account();
            $object->setName($this->faker->name)
                ->setNumber($this->faker->hexColor);

            $this->addReference('BASE_ACCOUNT' . $i, $object);

            $manager->persist($object);
        }

        for ($i = 0; $i < 10; $i++) {
            $object = new Account();
            $object->setName($this->faker->name)
                ->setNumber($this->faker->hexColor)
                ->setParentAccount($this->getReference('BASE_ACCOUNT' . random_int(0, 4)));

            $this->addReference('REGULAR_ACCOUNT' . $i, $object);

            $manager->persist($object);
        }

        for ($i = 0; $i < 1000; $i++) {
            $object = new Account();
            $object->setName($this->faker->name)
                ->setNumber($this->faker->hexColor)
                ->setParentAccount($this->getReference('REGULAR_ACCOUNT' . random_int(0, 9)));

            $this->addReference('NORMAL_ACCOUNT' . $i, $object);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
