<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LieuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $lieu = new Lieu();
            $ideeLieux = ['Bar', 'Escape Game', 'Théâtre', 'Cinéma', 'Restaurant'];
            $lieu->setNom($faker->randomElement($ideeLieux));
            $lieu->setRue($faker->streetAddress());
            $lieu->setLatitude($faker->latitude());
            $lieu->setLongitude($faker->longitude());
        $manager->persist($lieu);
        }

        $manager->flush();
    }
}
