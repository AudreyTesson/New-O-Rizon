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
    #[Route('/', name: 'app_front_main', methods: ['GET'])]
    public function home(
        CityRepository $cityRepository,
    ): Response
    {
        $cities = $cityRepository->findAll();

        return $this->render('front/main/index.html.twig', [
            'cities' => $cities,
        ]);
    }

    #[Route('/about-us', name: 'app_front_about_us', methods: ['GET'])]
    function aboutUs() {
        return $this->render('front/footer/about_us.html.twig');
    }

    #[Route('/legal-notices', name: 'app_front_legal_notices', methods: ['GET'])]
    function legalNotices() {
        return $this->render('front/footer/legal_notices.html.twig');        
    }
}
