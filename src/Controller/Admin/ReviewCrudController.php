<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    public function configureFields(string $pageName): iterable
    {
            // IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            yield IntegerField::new('rating', 'Notes')
            // ->hideOnIndex()
            ->setTemplatePath('admin/field/rating.html.twig')   
            ;

    }

}
