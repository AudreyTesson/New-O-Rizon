<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\LevelsField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    use Trait\ShowTrait;

    public static function getEntityFqcn(): string
    {
        return City::class ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();

        yield TextField::new('name', 'Nom');

        yield ArrayField::new('images', 'Images')
            ->setTemplatePath('admin/field/images.html.twig')   
            ->hideOnIndex()
            ;

        yield AssociationField::new('images', 'Images')
            ->setFormTypeOption('by_reference', false)
            ->autocomplete();

        yield AssociationField::new('country', 'Pays')
            ->autocomplete();
            
        yield TextField::new('language', 'Langue');   

        yield NumberField::new('demography', 'Démographie')
            ->hideOnIndex();

        yield NumberField::new('area', 'Superficie')->setRequired(true)
            ->hideOnIndex();

        yield DateTimeField::new('created_at', 'Créé le')->hideOnForm();

        yield DateTimeField::new('updated_at', 'Modifié le')->hideOnForm();

        yield TextField::new('electricity', 'Electricité')
            ->hideOnIndex()
            ->setRequired(true);

        yield NumberField::new('timezone')
            ->hideOnIndex()
            ->setRequired(true);

        yield TextField::new('sunshine_rate', 'Ensoleillement')
            ->hideOnIndex()
            ->setRequired(true);

        yield IntegerField::new('temperature_average', 'Température moyenne')
            ->hideOnIndex()
            ->setTemplatePath('admin/field/temperature_average.html.twig')   
            ;

        yield NumberField::new('cost', 'Coût de la vie')
            ->hideOnIndex();

        yield TextField::new('housing', 'Logement')
            ->hideOnIndex()
            ->setRequired(true);

        yield TextField::new('environment', 'Environnement')
            ->hideOnIndex();

        yield TextField::new('internet', 'Internet')
            ->hideOnIndex()
            ->setRequired(true);    
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof City) return;

        $entityInstance->setCreatedAt(new \DateTime());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
