<?php

namespace App\DataFixtures;

//use App\Entity\Etat;
use App\Entity\Sortie;
use App\Entity\User;
use App\Repository\EtatRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SortieFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [AppFixtures::class];
    }

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EtatRepository $etatRepository)
    {}

    public function load(ObjectManager $em): void
    {
        $faker = Factory::create('fr_FR');

        $etats = $this->etatRepository->findAll();

        for($i=1; $i<=10; $i++){

            $sortie = new Sortie();
            $index = $faker->numberBetween(0, AppFixtures::USER_COUNT - 1);
            $sortie->setOrganisateur($this->getReference('users_' . $index, User::class));
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
