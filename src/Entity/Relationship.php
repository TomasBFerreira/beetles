<?php

namespace App\Entity;

use App\Entity\Beetle;
use App\Repository\RelationshipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelationshipRepository::class)]

class Relationship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Beetle::class, inversedBy: 'relationships')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Beetle $parent = null;

    #[ORM\ManyToOne(targetEntity: Beetle::class, inversedBy: 'relationships')]
    #[ORM\JoinColumn(name: 'child_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?Beetle $child = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getParent(): ?Beetle
    {
        return $this->parent;
    }

    public function setParent(?Beetle $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?Beetle
    {
        return $this->child;
    }

    public function setChild(?Beetle $child): self
    {
        $this->child = $child;

        return $this;
    }
}
