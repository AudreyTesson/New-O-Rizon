<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Image;
use App\Entity\Review;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CityCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('New O Rizon, BackOffice');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-home', '/');

        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-dashboard');

        yield MenuItem::subMenu('Cities', 'fas fa-building')->setSubItems(
            [
            MenuItem::linkToCrud('Create City', 'fas fa-plus', City::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Cities', 'fas fa-eye', City::class),
            ]
        );

        yield MenuItem::subMenu('Countries', 'fas fa-globe')->setSubItems(
            [
            MenuItem::linkToCrud('Create Country', 'fas fa-plus', Country::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Countries', 'fas fa-eye', Country::class),
            ]
        );

        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);

        yield MenuItem::linkToCrud('Reviews', 'fas fa-star', Review::class);

        yield MenuItem::subMenu('Images', 'fas fa-image')->setSubItems(
            [
            MenuItem::linkToCrud('Create Image', 'fas fa-plus', Image::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Images', 'fas fa-eye', Image::class),
            ]
        );
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setSearchFields(['name', 'name'])
            ->setPaginatorPageSize(20)
            ->setPaginatorRangeSize(4);
    }
}
