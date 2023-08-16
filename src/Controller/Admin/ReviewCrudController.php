<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewCrudController extends AbstractCrudController
{
    use Trait\ShowTrait;

    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('content');

        yield AssociationField::new('username', 'User');

        yield AssociationField::new('city', 'City');

        yield IntegerField::new('rating', 'Notes')
            ->setTemplatePath('admin/field/rating.html.twig');
    }
}
