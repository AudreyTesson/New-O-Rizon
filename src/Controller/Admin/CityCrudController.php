<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\Image;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Faker\Provider\ar_EG\Text;
use Symfony\Component\HttpFoundation\Request;

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
            // TextEditorField::new('description'),
        yield ImageField::new('picture')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');

        yield ArrayField::new('images', 'Images')
            ->setTemplatePath('admin/field/images.html.twig')   
            ->onlyOnDetail();

        yield AssociationField::new('country', 'Pays')
        ->autocomplete();
        // LanguageField::new('language'),
        yield TextField::new('language', 'Langue');   

        yield NumberField::new('demography', 'Démographie')
        ->hideOnIndex();

        yield NumberField::new('area', 'Superficie')->setRequired(true)
        ->hideOnIndex();

        yield DateTimeField::new('created_at', 'Créé le')->hideOnForm();

        yield DateTimeField::new('updated_at', 'Modifié le')->hideOnForm();

        $levels= [
            'Non renseigné' => '',
            'Bas' => 'low',
            'Moyen' => 'medium',
            'Haut' => 'high',
        ];

        yield ChoiceField::new('electricity', 'Electricité')
            ->setRequired(false)
            ->hideOnIndex()
            ->setChoices(array_combine($levels, $levels))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges([
                '' => 'info',
                'low' => 'danger',
                'medium' => 'warning',
                'high' => 'success',
            ]);     

        yield NumberField::new('timezone')
            ->hideOnIndex()
            ->setRequired(true);

        yield ChoiceField::new('sunshine_rate', 'Ensoleillement')
            ->hideOnIndex()
            ->setChoices(array_combine($levels, $levels))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges([
                '' => 'info',
                'low' => 'danger',
                'medium' => 'warning',
                'high' => 'success',
            ]);     

        yield NumberField::new('temperature_average', 'Température moyenne')
            ->hideOnIndex();

        yield NumberField::new('cost', 'Coût de la vie')
            ->hideOnIndex();

        yield ChoiceField::new('housing', 'Logement')
            ->hideOnIndex()
            ->setChoices(array_combine($levels, $levels))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges([
                '' => 'info',
                'low' => 'danger',
                'medium' => 'warning',
                'high' => 'success',
            ]);     

        yield TextField::new('environment', 'Environnement')
            ->hideOnIndex();

        yield ChoiceField::new('internet', 'Internet')
        ->hideOnIndex()
        ->setChoices(array_combine($levels, $levels))
        ->allowMultipleChoices()
        ->renderExpanded()
        ->renderAsBadges([
            '' => 'info',
            'low' => 'danger',
            'medium' => 'warning',
            'high' => 'success',
        ]);        
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof City) return;

        $entityInstance->setCreatedAt(new \DateTime());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
