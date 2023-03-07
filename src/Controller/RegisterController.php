<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{

    // CONSTRUCTEUR

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/inscription', name: 'register')]

    
    
    // ENVOIE DES INFORMATIONS DANS BASE DE DONNEES
    
    public function index(Request $request, UserPasswordHasherInterface $encoder): Response
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();

            $password = $encoder->hashPassword($user,$user->getPassword());

            $user->setPassword($password);
            
            // Figer la data pour pouvoir l'enregistrer par la suite
            $this->entityManager->persist($user);
            // Tu prends l'objet (data) que tu as figé et tu l'enregistres en base de données
            $this->entityManager->flush();

            return $this->redirectToRoute("app_login");
        }
        
        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}