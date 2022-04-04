<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        // $films = $filmRepository->findAll(); // 4 requetes SQL
        $films = $filmRepository->findFilmAvecActeurs(); // 1 requete SQL
        // $films = $filmRepository->findFilm2000qb();
        return $this->render(
            'film/liste.html.twig',
            compact("films")
        );
    }

    #[Route('/film/ajouter', name: 'film_ajouter')]
    public function ajouter(
        EntityManagerInterface $em,
        Request                $request
    ): Response
    {

        $film = new Film();
        $filmForm = $this->createForm(FilmType::class, $film);

        $filmForm->handleRequest($request);

        if (
            $filmForm->isSubmitted()
            && $filmForm->isValid()
        ) {
            $em->persist($film);
            $em->flush();
            $this->addFlash(
                'bravo',
                'Le film a bien été ajouté'
            );
            return $this->redirectToRoute('film_liste');
        }

        return $this->render(
            'film/ajouter.html.twig',
            ['monFormulaire' => $filmForm->createView()]
        );
        // Avec notre copain compact(), on utilise renderForm()
        return $this->renderForm(
            'film/ajouter.html.twig',
            compact("filmForm")
        );
    }


    #[Route('/film/detail/{id}',
        name: 'film_detail',
        requirements: ["id" => "\d+"])]
    public function detail(
        Film $film
    ): Response
    {
        return $this->render(
            'film/detail.html.twig',
            compact("film")
        );
    }
}
