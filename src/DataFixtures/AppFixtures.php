<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
class AppFixtures extends Fixture implements DependentFixtureInterface{

    private UserPasswordHasherInterface $passwordHasher;
   public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const int USER_COUNT = 30;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < self::USER_COUNT; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->email());
            $user->setPrenom($faker->firstName());
            $user->setNom($faker->lastName());
            $user->setPseudo($faker->unique()->userName());
            $user->setNumTel($faker->phoneNumber(9));
            $user->setRoles(['ROLE_USER']);
            $user->setActif(true);
            $randomCampus = $this->getReference('campus_' . $faker->numberBetween(0, 4), Campus::class);
            $user->setCampus($randomCampus);



            $password = "test1234";
            $hashedPassword =$this->passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setPassword($hashedPassword);


            $manager->persist($user);
            $this->addReference('users_' . $i, $user);
        }

        $manager->flush();
    }



    public function getDependencies(): array
    {
        return [

            CampusFixtures::class,
        ];
    }
}
