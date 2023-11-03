<?php

namespace App\Repository;

use App\Entity\Beetle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beetle>
 *
 * @method Beetle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beetle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beetle[]    findAll()
 * @method Beetle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeetleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beetle::class);
    }

//    /**
//     * @return Beetle[] Returns an array of Beetle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Beetle
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
