<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Sortie;
use App\Entity\User;
use App\Repository\EtatRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SortieFixtures extends Fixture
{

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EtatRepository $etatRepository)
    {}

    public function load(ObjectManager $em): void
    {
        $faker = Factory::create('fr_FR');
        //récupère les users pour en choisir un aléatoirement aux fixture de sortie
        $users = $this->userRepository->findAll();
        $user = $faker->randomElement($users);

        //idem avec etat
        $etats = $this->etatRepository->findAll();
        $etat = $faker->randomElement($etats);

        $sortie = new Sortie();
        $sortie->setOrganisateur($user);
        $sortie->setNom("Sortie à la mer");
        $sortie->setDateHeureDebut(new \DateTimeImmutable("now"));
        $sortie->setDuree(7);
        $sortie->setEtat($etat);
        $sortie->setDateLimiteInscription(new \DateTimeImmutable("+30 days"));
        $sortie->setNbInscriptionMax(10);
        $sortie->setInfosSortie("rendez-vous devant le bar.");

        //$sortie->setCampus("Nantes");
        //$sortie->setLieu("Saint-tropez");

        $em->persist($sortie);

        $user1 = $faker->randomElement($users);
        $sortie1 = new Sortie();
        $sortie1->setOrganisateur($user1);
        $sortie1->setNom("Sortie à la montagne");
        $sortie1->setDateHeureDebut(new \DateTimeImmutable("now"));
        $sortie1->setDuree(7);
        $sortie1->setDateLimiteInscription(new \DateTimeImmutable("+30 days"));
        $sortie1->setNbInscriptionMax(8);
        $sortie1->setInfosSortie("rendez-vous devant le bar.");
        //$sortie1->setCampus("Nantes");
        //$sortie1->setLieu("Megève");
        $em->persist($sortie1);

        $user2 = $faker->randomElement($users);
        $sortie2 = new Sortie();
        $sortie2->setOrganisateur($user2);
        $sortie2->setNom("Escape game php");
        $sortie2->setDateHeureDebut(new \DateTimeImmutable(""));
        $sortie2->setDuree(1);
        $sortie2->setDateLimiteInscription(new \DateTimeImmutable("+30 days"));
        $sortie2->setNbInscriptionMax(25);
        $sortie2->setInfosSortie("rendez-vous devant le bar.");
        //$sortie2->setCampus("Nantes");
        //$sortie2->setLieu("Saint Herblain");
        $em->persist($sortie2);

        for($i=1; $i<=10; $i++){

            $sortie = new Sortie();
            $user = $faker->randomElement($users);
            $sortie->setOrganisateur($user);
            $sortie->setNom($faker->sentence($faker->numberBetween(3, 10)));

            $fk_dateHeureDebut = $faker->dateTimeBetween($startDate = '-30 days', $endDate = '+180 days', $timezone = null);
            $sortie->setDateHeureDebut(\DateTimeImmutable::createFromMutable($fk_dateHeureDebut));
            $sortie->setDuree($faker->numberBetween(1,20));

            $fk_dateLimite = clone $fk_dateHeureDebut->modify('+30 days');
            $sortie->setDateLimiteInscription(\DateTimeImmutable::createFromMutable($fk_dateLimite));
            $sortie->setNbInscriptionMax($faker->numberBetween(3,20));
            $sortie->setInfosSortie("rendez-vous devant le bar.");
            $etat = $faker->randomElement($etats);
            $sortie->setEtat($etat);
            //$sortie->setCampus($faker->city);
            //$sortie->setLieu($faker->city);
            $em->persist($sortie);
        }

        $em->flush();
    }
}
