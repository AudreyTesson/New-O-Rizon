<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\FilterDataType;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class SortController extends AbstractController
{
    #[Route('/cities/asc', name: 'sort_asc')]
    public function sortAscAction(CityRepository $cityRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $order = 'ASC';
        
        $cities = $cityRepository->findCountryAndImageByCity('ASC');

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            
            $order = 'ASC';
            $citiesFilter = $cityRepository->findByFilter($criteria, 'ASC');
            $citiesFilter = $paginatorInterface->paginate($citiesFilter, $request->query->getInt('page', 1),9);

            return $this->render('front/city/index.html.twig', ["citiesFilter" => $citiesFilter, 'sortOption' => $order, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        $cities = $paginatorInterface->paginate($cities, $request->query->getInt('page', 1),9);

        return $this->render('front/city/index.html.twig', [
            'cities' => $cities,
            'sortOption' => $order,
            'formFilter' => $formFilter->createView()
        ]);
    }

    #[Route('/cities/desc', name: 'sort_desc')]
    public function sortDescAction(CityRepository $cityRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $order = 'DESC';

        $cities = $cityRepository->findCountryAndImageByCity('DESC');

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            
            $order = 'DESC';
            $citiesFilter = $cityRepository->findByFilter($criteria, 'DESC');
            $citiesFilter = $paginatorInterface->paginate($citiesFilter, $request->query->getInt('page', 1),9);

            return $this->render('front/city/index.html.twig', ["citiesFilter" => $citiesFilter, 'sortOption' => $order, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        $cities = $paginatorInterface->paginate($cities, $request->query->getInt('page', 1), 9);
    
        return $this->render('front/city/index.html.twig', [
            'cities' => $cities,
            'sortOption' => $order,
            'formFilter' => $formFilter->createView()
        ]);
    }
}