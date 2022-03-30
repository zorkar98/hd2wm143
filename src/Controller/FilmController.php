<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function liste(
        FilmRepository $filmRepository
    ): Response
    {
        // $films = $filmRepository->findAll();
        $films = $filmRepository->findFilm2000();
        return $this->render(
            'film/liste.html.twig',
            compact("films")
        );
    }

    #[Route('/film/ajouter', name: 'film_ajouter')]
    public function ajouter(
        EntityManagerInterface $em
    ): Response
    {
        $film = new Film();
        $film->setTitre("Gladiator");
        $film->setAnnee(2000);

        $film2 = (new Film())
            ->setTitre("Morbius")
            ->setAnnee(2022);

        $em->persist($film); // Servlet -> BLL -> DAL -> BO -> DAL -> BLL -> Servlet
        $em->flush();

        return $this->render('film/ajouter.html.twig');
    }


    #[Route('/film/detail/{id}',
        name: 'film_detail',
        requirements: ["id" => "\d+"])]
    public function detail(
        FilmRepository $filmRepository,
        Film $film
    ): Response
    {
        return $this->render(
            'film/detail.html.twig',
            compact("film")
        );
    }
}
