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
    public function findFamilyTrees(): array
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.relationships', 'r')
            ->addSelect('r')
            ->getQuery()
            ->getResult();
    }

    public function findByName(string $name)
    {
        return $this->createQueryBuilder('b')
            ->where('b.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }

}
