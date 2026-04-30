<?php

namespace App\DataFixtures;
use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CampusFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $noms = ["Nantes", "Niort", "Rennes", "Quimper", "En ligne"];

        foreach ($noms as $i => $nom) {
            $campus = new Campus();
            $campus->setNom($nom);
            $manager->persist($campus);


            $this->addReference('campus_' . $i, $campus);
        }

        $manager->flush();
    }
}
