<?php

namespace App\Controller\Front;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\CityRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/reviews/{id}/review/add', name: 'app_front_review_add', requirements: ['id' => '\d+'])]
    public function index(
        $id,
        CityRepository $cityRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        ReviewRepository $reviewRepository
    ): Response
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        $reviewForForm = new Review();
        $city = $cityRepository->find($id);
    
        if ($city === null){ throw $this->createNotFoundException("Cette ville n'est pas encore enregistrée");}

        $form = $this->createForm(
            ReviewType::class,
            $reviewForForm);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {         
            $reviewForForm->setCity($city);

            $entityManagerInterface->persist($reviewForForm);
            $entityManagerInterface->flush();

            $reviewByCity = $reviewRepository->findBy([
                "city" => $city], ["created_at" => "DESC"]);
            $rating = [];
            foreach ($reviewByCity as $review) {
                $rating[] = $review->getRating();
            }
            $sum = array_sum($rating);
            $count = count($rating);
            if ($count !== 0) {
                $average = round($sum/$count, 1);
            } else {
                $average = 0;
            }
            $city->setRating($average);
            
            $entityManagerInterface->flush();    

            return $this->redirectToRoute("app_front_cities_detail", [
                "id" => $city->getId()]);
        }    

        return $this->render('front/review/index.html.twig', [
            'formulaire' => $form,
            'city' => $city
        ]);
    }
}
