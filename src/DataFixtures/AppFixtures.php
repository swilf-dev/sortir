<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
class AppFixtures extends Fixture{

private UserPasswordHasherInterface $passwordHasher;
   public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
    $faker = Factory::create('fr_FR');
    for($i = 0; $i < 30; $i++) {
        $user = new User();
        $user->setEmail($faker->unique()->email());
        $user->setPrenom($faker->firstName());
        $user->setNom($faker->lastName());
        $user->setPseudo($faker->unique()->userName());
        $user->setNumTel($faker->phoneNumber(9));
        $user->setRoles(['ROLE_USER']);
        $user->setActif(true);



        $password = "test1234";
        $hashedPassword =$this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);


        $manager->persist($user);
    }



        $manager->flush();
    }
}
