<?php

namespace App\Controller;

use App\Entity\Librarian;
use App\Entity\Member;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordHasherInterface $user_password_hasher, EntityManagerInterface $entity_manager): Response
    {
        $user = new Member();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $user_password_hasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entity_manager->persist($user);
            $entity_manager->flush();

            return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
