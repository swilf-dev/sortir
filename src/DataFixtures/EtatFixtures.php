<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {
        $etats= [
            'En création',
            'Ouverte',
            'Clôturée',
            'En cours',
            'Terminée',
            'Annulée',
            'Historisée'
        ];

        foreach ($etats as $libelle) {
            $etat = new Etat();
            $etat->setLibelle($libelle);

            $em->persist($etat);
        }

        $em->flush();
    }
}
