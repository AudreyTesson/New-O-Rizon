<?php

namespace App\Controller\Front;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    #[Route('/cities', name: 'app_front_cities_list')]
    public function index(
        CityRepository $cityRepository,
        ImageRepository $imageRepository,
    ): Response
    {
        $cities = $cityRepository->findCountryAndImageByCity();

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
