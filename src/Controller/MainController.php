<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('', name: "main_accueil")]
    public function accueil(): Response {
        $nombre = '<h1>42</h1>';
        $films = ['Gladiator', 'Terminator', 'Judge Dread'];
        return $this->render(
            'main/accueil.html.twig',
            compact("nombre", "films")
        );
    }

}