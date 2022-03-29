<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'film_index')]
    public function index(): Response
    {
        $voiture = 'tesla';
        dump($voiture);
        dump('Coucou');
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }

    #[Route('/film/liste', name: 'film_liste')]
    public function liste(): Response
    {
        return $this->render('film/liste.html.twig');
    }

    #[Route('/film/detail/{id}',
        name: 'film_detail',
        requirements: ["id" => "\d+"])]
    public function detail($id = 1): Response
    {
        return $this->render(
            'film/detail.html.twig',
            compact("id")
        );
    }
}
