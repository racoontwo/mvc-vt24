<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Find all products having a value above the specified one.
     *
     * @param int $value An input value with the value.
     *
     * @return mixed Returns an array of Product objects
     */
    public function findByMinimumValue($value): mixed
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.value >= :value')
            ->setParameter('value', $value)
            ->orderBy('p.value', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Find all producs having a value above the specified one with SQL.
     *
     * @param int $value An input value with the value.
     *
     * @return array|mixed [][] Returns an array of arrays (i.e. a raw data set)
     */
    public function findByMinimumValue2($value): mixed
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM product AS p
            WHERE p.value >= :value
            ORDER BY p.value ASC
        ';

        $resultSet = $conn->executeQuery($sql, ['value' => $value]);

        return $resultSet->fetchAllAssociative();
    }
}
