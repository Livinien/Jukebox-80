<?php

namespace App\Controller;


use App\Entity\Music;
use App\Entity\Favoris;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JukeboxMemberPlaylistController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    
    // ROUTE POUR ACCÉDER À LA PAGE PLAYLIST
    
    #[IsGranted('ROLE_MEMBER', 'ROLE_ADMIN')]
    #[Route('/playlist', name: 'app_jukebox_member_playlist')]
    
    public function index(): Response
    {

        $music = $this->entityManager->getRepository(Music::class)->findAll();
        
        return $this->render('jukebox_member_playlist/index.html.twig', [
            'music' => $music
        ]);
    }
    
    
    
    // ROUTE POUR AJOUTER LES MUSIQUES AUX FAVORIS
    
    #[Route('/favoris/add/{id}', name: 'add_favoris')]
    public function addFavorite(Music $music, ManagerRegistry $doctrine)
    {
        $music->addFavorite($this->getUser());

        $em = $doctrine->getManager();
        $em->persist($music);
        $em->flush();

        return $this->redirectToRoute('app_jukebox_member_playlist');
    }


    
    // ROUTE POUR SUPPRIMER LES MUSIQUES AUX FAVORIS
    
    #[Route('/favoris/delete/{id}', name: 'delete_favoris')]
    public function deleteFavorite(Music $music, ManagerRegistry $doctrine)
    {
        $music->removeFavorite($this->getUser());
        
        $em = $doctrine->getManager();
        $em->persist($music);
        $em->flush();

        return $this->redirectToRoute('app_jukebox_member_playlist');
    }
}