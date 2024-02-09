<?php

namespace App\Entity;

use App\Repository\BeetleRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: BeetleRepository::class)]

class Beetle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gen = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lineage = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $sex = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $length = null;
    
    #[ORM\ManyToOne(targetEntity: Relationship::class, inversedBy: "children")]
    private $childOf = null;

    #[ORM\ManyToOne(targetEntity: Relationship::class)]
    private $relationship = null;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGen(): ?string
    {
        return $this->gen;
    }

    public function setGen(?string $gen): static
    {
        $this->gen = $gen;

        return $this;
    }

    public function getLineage(): ?string
    {
        return $this->lineage;
    }

    public function setLineage(?string $lineage): static
    {
        $this->lineage = $lineage;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(?string $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getChildOf(): ?Relationship
    {
        return $this->childOf;
    }

    public function setChildOf(?Relationship $childOf): self
    {
        $this->childOf = $childOf;

        return $this;
    }

    public function getRelationship(): ?Relationship
    {
        return $this->relationship;
    }

    public function setRelationship(?Relationship $relationship): self
    {
        $this->relationship = $relationship;

        return $this;
    }
}
