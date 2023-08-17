<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritesController extends AbstractController
{
    #[Route('/favorites', name: 'app_front_favorites')]
    public function index(): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $favoritesList = $user->getCity();

        return $this->render('front/favorites/index.html.twig', [
            "city" => $favoritesList
        ]);
    }

    #[Route('/favorites/add/{id}', name: 'app_front_favorites_add', requirements: ['id' => '\d+'])]
    public function add($id, CityRepository $cityRepository, EntityManagerInterface $em, Request $request): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $city = $cityRepository->find($id);

        $route = $request->headers->get('referer');

        if ($city === null) { throw new Exception("ce favori n'existe pas.", 201);
        }
        if (!$user) { $this->redirectToRoute('app_login');
        } else {
            $city->addUser($user);
            $name = $city->getName();

            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                "$name a été ajouté à votre liste de favoris"
            );
        }

        return $this->redirect($route);
    }

    #[Route('/favorites/remove/{id}', name: 'app_front_favorites_remove', requirements: ['id' => '\d+'])]
    public function remove($id, CityRepository $cityRepository, EntityManagerInterface $em, Request $request):Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $city = $cityRepository->find($id);

        $route = $request->headers->get('referer');

        if ($city === null) { throw new Exception("ce favori n'existe pas.", 201);
        }
        if (!$user) { $this->redirectToRoute('app_login');
        } else {
            $city->removeUser($user);
            $name = $city->getName();

            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                "$name a été retiré de votre liste de favoris"
            );
        }

        return $this->redirect($route);
    }

    #[Route('/favorites/clear', name: 'app_front_favorites_clear')]
    public function removeAll(EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $favoritesList = $user->getCity();
        if ($favoritesList === null) { throw new Exception("ce favori n'existe pas.", 201);}

        foreach ($favoritesList as $cityFavorite) {
            $cityFavorite->removeUser($user);
            $em->persist($cityFavorite);
        }

        $em->flush();

        $this->addFlash(
            'success',
            "Les villes ont été supprimées de votre liste de favoris"
        );

        return $this->redirectToRoute("app_front_favorites");
    }
}
