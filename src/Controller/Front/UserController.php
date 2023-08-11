<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/sign-in', name: 'app_front_sign_in', methods: ['GET', 'POST'])]
    public function new(UserPasswordHasherInterface $passwordHasher, Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // get password to hash before setting property
            $plaintextPassword = $user->getPassword();
            $passwordHashed = $passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($passwordHashed);

            $user->setRoles(['ROLE_USER']);
            $userRepository->add($user, true);

            $this->addFlash(
                'success',
                'Félicitations ! ' . $user->getFirstname() . ' vous êtes un membre O\'rizon'
            );

            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);

        }

        return $this->render('front/user/sign_in.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}', name:'app_front_user_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('front/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/{id}/edit', name:'app_front_user_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            $this->addFlash(
                'success',
                'Merci ! ' . $user->getFirstname() . ', vos modifications ont été prises en compte.'
            );

            return $this->redirectToRoute('app_front_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/user/{id}/delete', name:'app_front_user_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {        

            $this->container->get('security.token_storage')->setToken(null);

            $userRepository->remove($user, true);
            
            $this->addFlash(
                'success',
                "Votre compte a bien été supprimé. 
                Toutes vos données personnelles ont été supprimées de notre base de données.
                Revenez quand vous voulez."
            );

            return $this->redirectToRoute('app_front_main', [], Response::HTTP_SEE_OTHER);
        }            
    }
}


