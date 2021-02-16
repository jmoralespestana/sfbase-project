<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class AppFixtures extends Fixture
{
    protected $faker;

    /**
     * UserFixtures constructor.
     * @param array $availableLocales
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
