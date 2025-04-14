<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brandID = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $modelID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBrandID(): ?Brand
    {
        return $this->brandID;
    }

    public function setBrandID(?Brand $brandID): static
    {
        $this->brandID = $brandID;

        return $this;
    }

    public function getModelID(): ?Model
    {
        return $this->modelID;
    }

    public function setModelID(?Model $modelID): static
    {
        $this->modelID = $modelID;

        return $this;
    }
}
