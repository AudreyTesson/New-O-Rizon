<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id');
            yield TextEditorField::new('content');
            yield AssociationField::new('username', 'User');
            yield AssociationField::new('city', 'City');
            yield IntegerField::new('rating', 'Notes')
            ->setTemplatePath('admin/field/rating.html.twig')   
            ;

    }

}
