<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserContactRepository::class)]
#[ApiResource]
class UserContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $phonePrefix = null;

    #[ORM\Column]
    private ?int $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $landlinePrefix = null;

    #[ORM\Column]
    private ?int $landlineNumber = null;

    #[ORM\ManyToOne(inversedBy: 'userContact')]
    private ?Agents $agents = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhonePrefix(): ?string
    {
        return $this->phonePrefix;
    }

    public function setPhonePrefix(string $phonePrefix): self
    {
        $this->phonePrefix = $phonePrefix;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getLandlinePrefix(): ?string
    {
        return $this->landlinePrefix;
    }

    public function setLandlinePrefix(string $landlinePrefix): self
    {
        $this->landlinePrefix = $landlinePrefix;

        return $this;
    }

    public function getLandlineNumber(): ?int
    {
        return $this->landlineNumber;
    }

    public function setLandlineNumber(int $landlineNumber): self
    {
        $this->landlineNumber = $landlineNumber;

        return $this;
    }

    public function getAgents(): ?Agents
    {
        return $this->agents;
    }

    public function setAgents(?Agents $agents): self
    {
        $this->agents = $agents;

        return $this;
    }
}
