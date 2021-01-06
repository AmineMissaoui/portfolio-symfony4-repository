<?php

namespace App\Repository;

use App\Entity\PortfolioImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PortfolioImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortfolioImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortfolioImages[]    findAll()
 * @method PortfolioImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortfolioImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PortfolioImages::class);
    }

    // /**
    //  * @return PortfolioImages[] Returns an array of PortfolioImages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PortfolioImages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
