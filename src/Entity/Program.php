<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
#[ApiResource]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Request>
     */
    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: 'program')]
    private Collection $requests;

    #[ORM\Column]
    private ?int $minInitialPayment = null;

    #[ORM\Column]
    private ?int $maxLoanTerm = null;

    #[ORM\Column]
    private ?float $interestRate = null;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Request>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Request $request): static
    {
        if (!$this->requests->contains($request)) {
            $this->requests->add($request);
            $request->setProgram($this);
        }

        return $this;
    }

    public function removeRequest(Request $request): static
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getProgram() === $this) {
                $request->setProgram(null);
            }
        }

        return $this;
    }

    public function getMinInitialPayment(): ?int
    {
        return $this->minInitialPayment;
    }

    public function setMinInitialPayment(int $minInitialPayment): static
    {
        $this->minInitialPayment = $minInitialPayment;

        return $this;
    }

    public function getMaxLoanTerm(): ?int
    {
        return $this->maxLoanTerm;
    }

    public function setMaxLoanTerm(int $maxLoanTerm): static
    {
        $this->maxLoanTerm = $maxLoanTerm;

        return $this;
    }

    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }
}
