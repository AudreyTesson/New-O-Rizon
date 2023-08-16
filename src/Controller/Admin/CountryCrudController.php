<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CountryCrudController extends AbstractCrudController
{
    use Trait\ShowTrait;
    
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('name');

        yield AssociationField::new('cities')
            ->autocomplete();

        yield BooleanField::new('visa_is_required')
            ->hideOnIndex();

        yield CurrencyField::new('currency')
            ->hideOnIndex();

        yield DateTimeField::new('created_at');
    }
}
