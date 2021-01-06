<?php

namespace App\Repository;

use App\Entity\PortfolioProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PortfolioProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortfolioProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortfolioProject[]    findAll()
 * @method PortfolioProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortfolioProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PortfolioProject::class);
    }

    // /**
    //  * @return PortfolioProject[] Returns an array of PortfolioProject objects
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
    public function findOneBySomeField($value): ?PortfolioProject
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
