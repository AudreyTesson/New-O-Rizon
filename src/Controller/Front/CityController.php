<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\ReviewRepository;
use App\Service\CallApiService;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CityController extends AbstractController
{
    private $client;
    
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/cities', name: 'app_front_cities_list')]
    public function index(
        CityRepository $cityRepository,
        Request $request,
        PaginatorInterface $paginator,
        // CallApiService $callApiService
    ): Response
    {
        // $response = $this->client->request(
        //     'GET',
        //     'https://api.unsplash.com/'
        // );
        $cities = $paginator->paginate(
            $cityRepository->findCountryAndImageByCity(),
            $request->query->getInt('page', 1),
            9
        );
        dump($cities);

        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            
            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginator->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->render('front/city/index.html.twig', [
                "citiesFilter" => $citiesFilter, 
                "cities" => $cities, 
                "formFilter" => $formFilter->createView(),
            ]);
        }

        return $this->render('front/city/index.html.twig', [
            'cities' => $cities,
            'formFilter' => $formFilter->createView(),
        ]);
    }

    #[Route('/cities/{id}', name: 'app_front_cities_detail', requirements: ['id' => '\d+'])]
    function show(
        $id,
        CityRepository $cityRepository,
        ReviewRepository $reviewRepository
    ) : Response {
        $city = $cityRepository->find($id);

        if ($city === null) {
            throw new Exception("Nous n'avons pas encore de données sur cette ville", 404);
        }

        $allReviews = $reviewRepository->findBy(
            [
                "city" => $city
            ]
        );

        return $this->render('front/city/show.html.twig', [
            'city' => $city,
            "allReviewFromBDD" => $allReviews,
        ]);
    }
}
