<?php

namespace App\Repository;

use App\Data\FilterData;
use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<City>
 *
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function save(City $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(City $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCountry($id)
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.country', 'co', 'WITH', 'co.id = :country_id')
            ->innerJoin('c.images', 'i')
            ->setParameter('country_id', $id)
            ->getQuery()
            ->getResult();
    }

    public function findByCityName($search)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('c.id AS cityId, c.name AS cityName, c.rating AS cityRating, co.id AS countryId, co.name AS countryName, i.id AS imageId, i.url AS imageUrl')
            ->from(City::class, 'c')
            ->where($queryBuilder->expr()->like('c.name', ':name'))
            ->innerJoin('c.country', 'co')
            ->innerJoin('c.images', 'i')
            ->andWhere($queryBuilder->expr()->eq(
                '(SELECT COUNT(img.id) 
                    FROM App\Entity\Image img 
                    WHERE img.city = c.id 
                    AND img.id <= i.id)',
                1
            ))
            ->orderBy('c.name', 'ASC')
            ->setParameter('name', "$search%");

        return $queryBuilder->getQuery()->getResult();
    }

    public function findCountryAndImageByCity($order = null)
    {
        $entityManager = $this->getEntityManager();

        $dql = "
        SELECT c.id AS id, i.id AS imageId, i.url AS imageUrl, c.name AS name, c.rating AS cityRating, c.area AS cityArea, c.createdAt AS cityCreatedAt, c.updatedAt AS cityUpdatedAt, c.electricity AS cityElectricity, c.internet AS cityInternet, c.sunshineRate AS citySunshineRate, c.temperatureAverage AS cityTemperatureAverage, c.cost AS cityCost, c.language AS cityLanguage, c.demography AS cityDemography, c.housing AS cityHousing, c.timezone AS cityTimezone, c.environment AS cityEnvironment, co.name AS countryName, co.id AS countryId
        FROM App\Entity\City c
        JOIN App\Entity\Image i WITH i.city = c
        JOIN App\Entity\Country co WITH c.country = co
        WHERE (
            SELECT COUNT(img.id) 
            FROM App\Entity\Image img 
            WHERE img.city = c.id 
            AND img.id <= i.id) 
            = 1
        GROUP BY co.id
        ";

        if ($order !== null) {
            $dql .= " ORDER BY c.name " . ($order === 'ASC' ? 'ASC' : 'DESC');
        }

        $query = $entityManager->createQuery($dql);
        $sortedCities = $query->getResult();

        return $sortedCities;
    }

    public function findByFilter(FilterData $filterData, $order = null)
    {
        $query = $this->createQueryBuilder('city')
            ->select('city', 'c')
            ->join('city.country', 'c');

            // electricity
            if (!empty($filterData->electricityLevel)) {
                $query = $query
                    ->andWhere('city.electricity LIKE :filterData')
                    ->setParameter("filterData", "%$filterData->electricityLevel%");
            }
            // internet
            if (!empty($filterData->internetLevel)) {
                $query = $query
                    ->andWhere('city.internet LIKE :filterData')
                    ->setParameter("filterData", "%$filterData->internetLevel%");
            }
            // sunshine
            if (!empty($filterData->sunshineLevel)) {
                $query = $query
                    ->andWhere('city.sunshineRate LIKE :filterData')
                    ->setParameter("filterData", "%$filterData->sunshineLevel%");
            }
            // housing
            if (!empty($filterData->housingLevel)) {
                $query = $query
                    ->andWhere('city.housing LIKE :filterData')
                    ->setParameter("filterData", "%$filterData->housingLevel%");
            }
            // temperature
            if (!empty($filterData->temperatureMin)) {
                $query = $query
                    ->andWhere('city.temperatureAverage >= :temperatureMin')
                    ->setParameter('temperatureMin', $filterData->temperatureMin);
            }
            if (!empty($filterData->temperatureMax)) {
                $query = $query
                    ->andWhere('city.temperatureAverage <= :temperatureMax')
                    ->setParameter('temperatureMax', $filterData->temperatureMax);
            }
            // demography
            if (!empty($filterData->demographyMin)) {
                $query = $query
                    ->andWhere('city.demography >= :demographyMin')
                    ->setParameter('demographyMin', $filterData->demographyMin);
            }
            if (!empty($filterData->demographyMax)) {
                $query = $query
                    ->andWhere('city.demography <= :demographyMax')
                    ->setParameter('demographyMax', $filterData->demographyMax);
            }
            // cost
            if (!empty($filterData->costMin)) {
                $query = $query
                    ->andWhere('city.cost >= :costMin')
                    ->setParameter('costMin', $filterData->costMin);
            }
            if (!empty($filterData->costMax)) {
                $query = $query
                    ->andWhere('city.cost <= :costMax')
                    ->setParameter('costMax', $filterData->costMax);
            }
            // area
            if (!empty($filterData->areaMin)) {
                $query = $query
                    ->andWhere('city.area >= :areaMin')
                    ->setParameter('areaMin', $filterData->areaMin);
            }
            if (!empty($filterData->areaMax)) {
                $query = $query
                    ->andWhere('city.area >= :areaMax')
                    ->setParameter('areaMax', $filterData->areaMax);
            }
            // timezone
            if (!empty($filterData->timezone)) {
                $query = $query
                    ->andWhere('city.timezone = :timezone')
                    ->setParameter('timezone', $filterData->timezone);
            }
            // currency
            if (!empty($filterData->currencyType)) {
                $query = $query
                    ->andWhere('c.currency = :currencyType')
                    ->setParameter('currencyType', $filterData->currencyType);
            }
            // visa
            if (!empty($filterData->visaRequired)) {
                $query = $query
                    ->andWhere('c.visaIsRequired = 1');
            }
            if (!empty($filterData->visaType)) {
                $query = $query
                    ->andWhere('c.visa = :visaType')
                    ->setParameter('visaType', $filterData->visaType);
            }
            // language
            if (!empty($filterData->language)) {
                $query = $query
                    ->andWhere('city.language = :language')
                    ->setParameter('language', $filterData->language);  
            }
            // environment
            if (!empty($filterData->environment)) {
                $query = $query
                    ->andWhere('city.environment = :environment')
                    ->setParameter('environment', $filterData->environment);  
            }

            if ($order !== null) {
                $query = $query->orderBy("city.name", $order);
            }

        return $query->getQuery()->getResult();  
    }
}
