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
    public function findFamilyTrees()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->select('b')
            ->leftJoin('b.offspring', 'o')
            ->addSelect('o')
            ->where('b.maleParent IS NULL AND b.femaleParent IS NULL');

        $query = $qb->getQuery();

        return $query->getResult();
    }
}