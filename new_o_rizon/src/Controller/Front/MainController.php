<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_front_main')]
    public function home(
        CityRepository $cityRepository,
    ): Response
    {
        $cities = $cityRepository->findAll();

        return $this->render('front/main/index.html.twig', [
            'cities' => $cities,
        ]);
    }
}
