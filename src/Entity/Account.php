<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"},"enable_max_depth"="true"},
 *     denormalizationContext={"groups"={"write"},"enable_max_depth"="true"}
 * )
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"read","write"})
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="subAccounts")
     * @Groups({"read"})
     */
    private $parentAccount;

    /**
     * @ORM\OneToMany(targetEntity=Account::class, mappedBy="parentAccount", cascade={"persist"})
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read","write"})
     */
    private $subAccounts;

    public function __construct()
    {
        $this->subAccounts = new ArrayCollection();
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getParentAccount(): ?self
    {
        return $this->parentAccount;
    }

    public function setParentAccount(?self $parentAccount): self
    {
        $this->parentAccount = $parentAccount;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubAccounts(): Collection
    {
        return $this->subAccounts;
    }

    public function addSubAccount(self $subAccount): self
    {
        if (!$this->subAccounts->contains($subAccount)) {
            $this->subAccounts[] = $subAccount;
            $subAccount->setParentAccount($this);
        }

        return $this;
    }

    public function removeSubAccount(self $subAccount): self
    {
        if ($this->subAccounts->removeElement($subAccount)) {
            // set the owning side to null (unless already changed)
            if ($subAccount->getParentAccount() === $this) {
                $subAccount->setParentAccount(null);
            }
        }

        return $this;
    }
}
