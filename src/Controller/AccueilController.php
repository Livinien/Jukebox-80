<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{

    // ROUTE POUR ACCÉDER À L'ACCUEIL DE JUKEBOX 80
    
    #[Route('/', name: 'accueil')]
 
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig');
    }
}