<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SortieController extends AbstractController
{
    #[Route('/sortie', name: 'app_sortie')]
    public function index(): Response
    {
        return $this->render('sortie/index.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }

    #[Route('/sortie/liste', name: 'app_sortie_liste')]
    public function liste(SortieRepository $sortieRepository): Response{
        return $this->render('sortie/index.html.twig', [
            'sorties' => $sortieRepository->findAll(),

        ]);
    }

    #[Route('/sortie/creer', name: 'app_sortie_creer')]
    public function creer(Request $request, EntityManagerInterface $em, EtatRepository $etatRepository): Response
    {
        $sortie = new Sortie();
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->get('action') === 'publier') {
                $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
            } else {
                $etat = $etatRepository->findOneBy(['libelle' => 'En création']);
            }

            $sortie->setEtat($etat);
            $sortie->setOrganisateur($this->getUser());
            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success', 'Sortie enregistrée avec succès !');
            return $this->redirectToRoute('app_sortie');
        }

        return $this->render('sortie/creer.html.twig', [
            'form' => $form,
        ]);
    }
}
