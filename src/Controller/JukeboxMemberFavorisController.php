<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JukeboxMemberFavorisController extends AbstractController
{

    
    
    #[IsGranted('ROLE_MEMBER', 'ROLE_ADMIN')]
    #[Route('/favoris', name: 'app_jukebox_member_favoris')]
    public function index(): Response
    {
        
        return $this->render('jukebox_member_favoris/index.html.twig');
    }
}