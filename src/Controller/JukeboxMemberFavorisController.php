<?php

namespace App\Controller;

use App\Entity\Music;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JukeboxMemberFavorisController extends AbstractController
{

    // ACCÉDER À LA PAGE FAVORIS

    #[IsGranted('ROLE_MEMBER', 'ROLE_ADMIN')]
    #[Route('/favoris', name: 'app_favoris')]
    public function favoris(MusicRepository $music, ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        $userId = $user->getId();

        $queryBuilder = $doctrine->getManager()->createQueryBuilder()
        ->select('m')
        ->from(Music::class, 'm')
        ->join('m.favorite', 'f')
        ->where('f.id = :userId')
        ->setParameter('userId', $userId);
        $favorites = $queryBuilder->getQuery()->getResult();
    
        // $repository = $doctrine->getRepository(Music::class)->findBy(['favoris'=>$user]);
        return $this->render('jukebox_member_favoris/index.html.twig', [
            'favoris' => $favorites
        ]);
    }
}