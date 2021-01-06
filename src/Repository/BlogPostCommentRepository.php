<?php

namespace App\Repository;

use App\Entity\BlogPostComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostComment[]    findAll()
 * @method BlogPostComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostComment::class);
    }

    // /**
    //  * @return BlogPostComment[] Returns an array of BlogPostComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogPostComment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
