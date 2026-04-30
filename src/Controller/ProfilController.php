<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil', requirements: ['id' => '\d+'])]
    public function index(User $user) : Response
    {
        return $this->render('profil/index.html.twig', [
            'user' => $user,


        ]);
    }
}
