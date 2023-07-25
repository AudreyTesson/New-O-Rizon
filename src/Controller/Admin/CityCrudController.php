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
        return City::class ;
    }

    public function configureFields(string $pageName): iterable
    {
        $cityRepository = $this->entityManager->getRepository(City::class);
        $cities = $cityRepository->findAll();
        
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name', 'Nom');

            // TextEditorField::new('description'),
        yield ImageField::new('picture')
            ->setBasePath('/uploads/images/')
            ->setUploadDir('public/uploads/images/');

        // yield CollectionField::new('images')
        //     ->setLabel('Images')
        //     ->setTemplatePath('admin/field/images.html.twig')
        //     ->setCustomOption('cities', $cities);
        
        // yield AssociationField::new('images')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
        //     // dd($queryBuilder->getDQL());
        //     return $queryBuilder
        //         ->select('i.id', 'i.url')
        //         ->from(Image::class, 'c')
        //         ->leftJoin('c.city', 'i')
        //         ->where('i.id = :city')
    // });

                    // ->setParameter('city', $this->request->query->get('entityId'))

                    // SELECT c.id AS id, i.id AS imageId, i.url AS imageUrl, c.name AS name, c.area AS cityArea, c.createdAt AS cityCreatedAt, c.updatedAt AS cityUpdatedAt, c.electricity AS cityElectricity, c.internet AS cityInternet, c.sunshineRate AS citySunshineRate, c.temperatureAverage AS cityTemperatureAverage, c.cost AS cityCost, c.language AS cityLanguage, c.demography AS cityDemography, c.housing AS cityHousing, c.timezone AS cityTimezone, c.environment AS cityEnvironment, co.name AS countryName, co.id AS countryId
                    // FROM App\Entity\City c
                    // JOIN App\Entity\Image i WITH i.city = c
                    // JOIN App\Entity\Country co WITH c.country = co
                    // WHERE (
                    //     SELECT COUNT(img.id) 
                    //     FROM App\Entity\Image img 
                    //     WHERE img.city = c.id 
                    //     AND img.id <= i.id) 
                    //     = 1
                    // GROUP BY co.id
                    // ->setParameter('city', $this->request->query->get('entityId'))
                    ;

            //     ->setBasePath('/uploads/images/'),

            // CollectionField::new('images')->useEntryCrudForm(ImageCrudController::class),

        yield ArrayField::new('images', 'Images')
        ->setTemplatePath('admin/field/images.html.twig')
                        
            ->onlyOnDetail(
                // [
                    // ImageField::new('images', 'Image')
                        // ->setBasePath('/uploads/images/')
                        // ->setUploadDir('public/uploads/images/')
                        // ->setRequired(false)
                        // ->onlyOnForms(),
                        
                    // TextField::new('url', 'Image')
                    //     ->onlyOnDetail(),
                // ]
            );

        // yield AssociationField::new('images')->renderAsEmbeddedForm()
        yield  AssociationField::new('country', 'Pays');
        // LanguageField::new('language'),
        yield TextField::new('language', 'Langue');       
        yield NumberField::new('demography', 'Démographie');
        yield NumberField::new('area', 'Superficie')->setRequired(true);
        yield DateTimeField::new('created_at', 'Créé le')->hideOnForm();
        yield  DateTimeField::new('updated_at', 'Modifié le')->hideOnForm();
        yield TextField::new('electricity', 'Electricité')
            ->setRequired(false)
            ->onlyOnDetail();
        yield  NumberField::new('timezone')
            ->onlyOnDetail()
            ->onlyOnForms()
            ->setRequired(true);
        yield TextField::new('sunshine_rate', 'Ensoleillement')
            ->onlyOnDetail();

            

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

        // ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof City) return;

        $entityInstance->setCreatedAt(new \DateTime());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
