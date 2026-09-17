<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\CarFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CarFactory::createMany(5);

        $manager->flush();
    }
}
