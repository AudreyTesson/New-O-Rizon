<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    #[Route('/city', name: 'app_front_city')]
    public function index(): Response
    {
        return $this->render('front/city/index.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }
}
