<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    #[Route('/country', name: 'app_front_country')]
    public function index(): Response
    {
        return $this->render('front/country/index.html.twig', [
            'controller_name' => 'CountryController',
        ]);
    }
}
