<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VilleFixtures extends Fixture //implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $ville = new Ville();
            $ville->setNom($faker->city());
            $ville->setCodePostal($faker->postcode());
            /*$randomSortie = $this->getReference('sortie_' . $faker->numberBetween(0, 9), Sortie::class);
            $ville = setSortie($randomSortie);*/
            $manager->persist($ville);
        }

        $manager->flush();
    }
}

   /* public function getDependencies(): array
    {
        return [

            SortieFixtures::class,
        ];
    }
}
// TODO $this->addReference('sortie' . $i, $sortie) dans le sortie fixtures*/
