<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation as Api;

/**
 * @Api\ApiResource(
 *     collectionOperations={
 *          "get" = { "security" = "is_granted('ROLE_MODULE0_GOD', object)" ,"security_message"="No one is SILVER"},
 *          "post"
 *     },
 *     itemOperations={
 *          "get" = { "security" = "is_granted('ROLE_MODULE0_VIP', object)" },
 *          "put",
 *          "delete",
 *     },
 * )
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="company", orphanRemoval=true)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=SecurityGroup::class, mappedBy="company", orphanRemoval=true)
     */
    private $securityGroups;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->securityGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SecurityGroup[]
     */
    public function getSecurityGroups(): Collection
    {
        return $this->securityGroups;
    }

    public function addSecurityGroup(SecurityGroup $securityGroup): self
    {
        if (!$this->securityGroups->contains($securityGroup)) {
            $this->securityGroups[] = $securityGroup;
            $securityGroup->setCompany($this);
        }

        return $this;
    }

    public function removeSecurityGroup(SecurityGroup $securityGroup): self
    {
        if ($this->securityGroups->removeElement($securityGroup)) {
            // set the owning side to null (unless already changed)
            if ($securityGroup->getCompany() === $this) {
                $securityGroup->setCompany(null);
            }
        }

        return $this;
    }
}
