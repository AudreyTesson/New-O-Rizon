<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    #[Route('/cities', name: 'app_front_cities_list')]
    public function index(
        CityRepository $cityRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response
    {
        $cities = $paginator->paginate(
            $cityRepository->findCountryAndImageByCity(),
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('front/city/index.html.twig', [
            'cities' => $cities,
        ]);
    }

    #[Route('/cities/{id}', name: 'app_front_cities_detail', requirements: ['id' => '\d+'])]
    function show(
        $id,
        CityRepository $cityRepository,
    ) : Response {
        $city = $cityRepository->find($id);

        return $this->render('front/city/show.html.twig', [
            'city' => $city,
        ]);
    }
}
