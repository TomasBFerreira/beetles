<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Beetle;
use App\Repository\RelationshipRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationshipRepository::class)]

class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne()]
    #[ORM\JoinColumn(nullable: false)]
    private Beetle $father;

    #[ORM\ManyToOne()]
    #[ORM\JoinColumn(nullable: false)]
    private Beetle $mother;

    #[ORM\OneToMany(targetEntity: Beetle::class, mappedBy: 'childOf')]
    private Collection $children;
    public function __construct(Beetle $father, Beetle $mother)
    {
        $this->children = new ArrayCollection();
        $this->father = $father;
        $this->mother = $mother;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFather(): Beetle
    {
        return $this->father;
    }
    
    public function getMother(): Beetle
    {
        return $this->mother;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }
}
