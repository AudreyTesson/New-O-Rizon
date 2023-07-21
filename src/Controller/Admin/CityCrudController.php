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

    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    // private $CityRepository;
    // private $request;

    // public function __construct(CityRepository $cityRepository, Request $request) {
    //     $this->CityRepository = $cityRepository;
    //     $this->request = $request;
    // }

    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $cityRepository = $this->entityManager->getRepository(City::class);
        $cities = $cityRepository->findAll();
        
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            // TextEditorField::new('description'),
            ImageField::new('picture')
                ->setBasePath('/uploads/images/')
                ->setUploadDir('public/uploads/images/'),

            // CollectionField::new('images'),
            // AssociationField::new('images'),

            //     ->setBasePath('/uploads/images/'),

            // CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class),

            ArrayField::new('images', 'Images')
                ->onlyOnDetail(
                    [
                        ImageField::new('images', 'Image')
                            // ->setBasePath('/uploads/images/')
                            // ->setUploadDir('public/uploads/images/')
                            ->setRequired(false)
                            // ->onlyOnForms(),
                            ,
                        // TextField::new('url', 'Image')
                        //     ->onlyOnDetail(),
                    ]
                ),

            // yield AssociationField::new('images')->renderAsEmbeddedForm()
            AssociationField::new('country', 'Pays'),
            // LanguageField::new('language'),
            TextField::new('language', 'Langue'),
            NumberField::new('demography', 'Démographie'),
            NumberField::new('area', 'Superficie')->setRequired(true),
            DateTimeField::new('created_at', 'Créé le')->hideOnForm(),
            DateTimeField::new('updated_at', 'Modifié le')->hideOnForm(),
            TextField::new('electricity', 'Electricité')
                ->setRequired(false)
                ->onlyOnDetail(),
            NumberField::new('timezone')
                ->onlyOnDetail()
                ->onlyOnForms()
                ->setRequired(true),
            TextField::new('sunshine_rate', 'Ensoleillement')
                ->onlyOnDetail(),

            

        //     AssociationField::new('images')
        //     ->setFormType(ImageType::class)
        // ->setLabel('Images')

        // ->onlyOnDetail()
            // AssociationField::new('images')->setCrudController(ImageCrudController::class)

            // TextEditorField::new('images')
            // ->setLabel('Images')
            // ->setTemplatePath('@EasyAdmin/crud/field/images.html.twig')
            // ->setCustomOption('images', $cities)
            // ->hideOnForm()
            // ->onlyOnDetail()

            // AssociationField::new('images')->setQueryBuilder(
            //     fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Foo::class)->findCountryAndImageByCity()
            // ),

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof City) return;

        $entityInstance->setCreatedAt(new \DateTime());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
