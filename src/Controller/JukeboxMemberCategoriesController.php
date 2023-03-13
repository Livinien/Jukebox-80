<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JukeboxMemberCategoriesController extends AbstractController
{

    // ROUTE POUR ACCÉDER À LA PAGE CATÉGORIES
    #[IsGranted('ROLE_MEMBER', 'ROLE_ADMIN')]
    #[Route('/categories', name: 'app_jukebox_member_categories')]
    
    public function index(): Response
    {
        
        return $this->render('jukebox_member_categories/index.html.twig');
    }
}