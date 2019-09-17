<?php

namespace App\Repository;

use App\Entity\Userblog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Userblog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Userblog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Userblog[]    findAll()
 * @method Userblog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserblogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Userblog::class);
    }

    // /**
    //  * @return Userblog[] Returns an array of Userblog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Userblog
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
