<?php

namespace App\Repository;

use App\Entity\Grid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Grid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grid[]    findAll()
 * @method Grid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GridRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Grid::class);
    }

    // /**
    //  * @return Grid[] Returns an array of Grid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grid
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
