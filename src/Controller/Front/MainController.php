<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_front_main')]
    public function home(
        CityRepository $cityRepository, 
        Request $request, 
        PaginatorInterface $paginator): Response
    {
        $cities = $cityRepository->findCountryAndImageByCity('ASC');

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);
        

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {

            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginator->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->render('front/city/index.html.twig', ["citiesFilter" => $citiesFilter, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        return $this->render('front/main/index.html.twig', [
            'formFilter' => $formFilter->createView(),
            'cities' => $cities,
        ]);
    }

    #[Route('/search', name: 'app_front_city_search')]
    public function search(
        CityRepository $cityRepository, 
        Request $request,
        PaginatorInterface $paginator): Response
    {   
        $search = $request->query->get('search', '');

        $cities = $cityRepository->findByCityName($search);
        
        if ($cities === []) {
            throw $this->createNotFoundException("Cette ville n'est pas répertoriée/n'existe pas");
        }

        $cities = $paginator->paginate($cities, $request->query->getInt('page', 1),6);
        
        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);
        

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {

            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginator->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->render('front/city/index.html.twig', ["citiesFilter" => $citiesFilter, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        return $this->render('front/city/index.html.twig', [
            'formFilter' => $formFilter->createView(),
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
