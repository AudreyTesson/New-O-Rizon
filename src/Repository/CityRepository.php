<?php

namespace App\Repository;

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

    public function findCountryAndImageByCity($order = null)
    {
        $entityManager = $this->getEntityManager();

        $dql = "
        SELECT c.id AS id, i.id AS imageId, i.url AS imageUrl, c.name AS name, c.area AS cityArea, c.createdAt AS cityCreatedAt, c.updatedAt AS cityUpdatedAt, c.electricity AS cityElectricity, c.internet AS cityInternet, c.sunshineRate AS citySunshineRate, c.temperatureAverage AS cityTemperatureAverage, c.cost AS cityCost, c.language AS cityLanguage, c.demography AS cityDemography, c.housing AS cityHousing, c.timezone AS cityTimezone, c.environment AS cityEnvironment, co.name AS countryName, co.id AS countryId
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

        $sortedCities = $query->getResult();

        return $sortedCities;
    }

//    /**
//     * @return City[] Returns an array of City objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?City
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
