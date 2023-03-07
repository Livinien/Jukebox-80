<?php

namespace App\Controller;

use App\Entity\Music;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JukeboxMemberPlaylistController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    
    #[IsGranted('ROLE_MEMBER', 'ROLE_ADMIN')]
    #[Route('/playlist', name: 'app_jukebox_member_playlist')]
    
    public function index(): Response
    {

        $music = $this->entityManager->getRepository(Music::class)->findAll();
        
        
        return $this->render('jukebox_member_playlist/index.html.twig', [
            'music' => $music
        ]);
    }
}