<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SortieFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {
        $sortie = new Sortie();
        $sortie->setNom("Sortie à la mer");
        $sortie->setDateHeureDebut(new \DateTimeImmutable("now"));
        $sortie->setDuree(7);
        $sortie->setDateLimiteInscription(new \DateTimeImmutable("+30 days"));

        $sortie->setCampus("Nantes");
        $sortie->setOrganisateur("Bob");
        $sortie->setLieu("Saint-tropez");

        $em->persist($sortie);

        $sortie1 = new Sortie();
        $sortie1->setNom("Sortie à la montagne");
        $sortie1->setDateHeureDebut(new \DateTimeImmutable("now"));
        $sortie1->setDuree(7);
        $sortie1->setCampus("Nantes");
        $sortie1->setOrganisateur("Bob");
        $sortie1->setLieu("Megève");
        $em->persist($sortie1);

        $sortie2 = new Sortie();
        $sortie2->setNom("Escape game php");
        $sortie2->setDateHeureDebut(new \DateTimeImmutable(""));
        $sortie2->setDuree(1);
        $sortie2->setCampus("Nantes");
        $sortie2->setOrganisateur("Lilly");
        $sortie2->setLieu("Saint Herblain");
        $em->persist($sortie2);

        $faker = Factory::create('fr_FR');
        for($i=1; $i<=10; $i++){
            $sortie = new Sortie();
            $sortie->setNom($faker->name);

            $fk_dateHeureDebut = $faker->dateTimeBetween($startDate = '-30 days', $endDate = '+180 days', $timezone = null);
            $sortie->setDateHeureDebut(\DateTimeImmutable::createFromMutable($fk_dateHeureDebut));
            $sortie->setDuree($faker->numberBetween(1,20));
            $sortie->setCampus($faker->city);
            $sortie->setOrganisateur($faker->name);
            $sortie->setLieu($faker->city);
        }

        $em->flush();
    }
}
