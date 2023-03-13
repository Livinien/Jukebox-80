<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    // ROUTE POUR ACCÉDER À LA PAGE PROFIL DE L'UTILISATEUR
    #[Route('/profil', name: 'app_account')]
    public function index(): Response
    {
        
        return $this->render('account/index.html.twig');
    }
}