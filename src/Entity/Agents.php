<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AgentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentsRepository::class)]
#[ApiResource]
class Agents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id =  null;

    #[ORM\Column]
    private ?string $userId = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $emailPec = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $roles = [];

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastLogin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'agents')]
    private ?userAddress $userAddresss = null;

    #[ORM\OneToMany(mappedBy: 'agents', targetEntity: userContact::class)]
    private Collection $userContact;

    public function __construct()
    {
        $this->userContact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailPec(): ?string
    {
        return $this->emailPec;
    }

    public function setEmailPec(string $emailPec): self
    {
        $this->emailPec = $emailPec;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = ['ROLE_USER'];

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUserAddress(): ?userAddress
    {
        return $this->userAddresss;
    }

    public function setUserAddress(?userAddress $userAddresss): self
    {
        $this->userAddresss = $userAddresss;

        return $this;
    }

    /**
     * @return Collection<int, userContact>
     */
    public function getUserContact(): Collection
    {
        return $this->userContact;
    }

    public function addUserContact(userContact $userContact): self
    {
        if (!$this->userContact->contains($userContact)) {
            $this->userContact->add($userContact);
            $userContact->setAgents($this);
        }

        return $this;
    }

    public function removeUserContact(userContact $userContact): self
    {
        if ($this->userContact->removeElement($userContact)) {
            // set the owning side to null (unless already changed)
            if ($userContact->getAgents() === $this) {
                $userContact->setAgents(null);
            }
        }

        return $this;
    }
}
