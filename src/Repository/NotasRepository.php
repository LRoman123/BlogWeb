<?php

namespace App\Repository;

use App\Entity\Notas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Notas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notas[]    findAll()
 * @method Notas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notas::class);
    }

    // /**
    //  * @return Notas[] Returns an array of Notas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Notas
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
