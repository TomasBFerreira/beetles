<?php

namespace App\Repository;

use App\Entity\Relationship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Relationship>
 *
 * @method Relation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relation[]    findAll()
 * @method Relation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relationship::class);
    }
 
    /**
     * Find all relationships
     *
     * @return Relationship[]
     */
    public function findAllRelationships(): array
    {
        return $this->findAll();
    }


    /**
     * Find relationships filtered by user input
     *
     * @param string $input User input to filter relationships
     * @return Relationship[]
     */
    public function findFilteredRelationships(string $input): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.father', 'father')
            ->join('r.mother', 'mother')
            ->andWhere('father.name LIKE :input OR mother.name LIKE :input')
            ->setParameter('input', '%'.$input.'%')
            ->orderBy('r.father', 'ASC')
            ->addOrderBy('r.mother', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
