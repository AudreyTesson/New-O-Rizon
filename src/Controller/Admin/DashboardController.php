<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Image;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CityCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('New O Rizon');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-home', '/');

        yield MenuItem::subMenu('Cities', 'fas fa-bars')->setSubItems(
            [
            MenuItem::linkToCrud('Create City', 'fas fa-plus', City::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Cities', 'fas fa-eye', City::class),
            ]
        );

        yield MenuItem::subMenu('Countries', 'fas fa-bars')->setSubItems(
            [
            MenuItem::linkToCrud('Create Country', 'fas fa-plus', Country::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Countries', 'fas fa-eye', Country::class),
            ]
        );

        yield MenuItem::subMenu('Users', 'fas fa-user')->setSubItems(
            [
            MenuItem::linkToCrud('Create User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users', 'fas fa-eye', User::class),
            ]
        );

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
