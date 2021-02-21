<?php

namespace App\Entity;

use App\Repository\MiembrosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MiembrosRepository::class)
 */
class Miembros
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Equipo::class, inversedBy="integrantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="equipo")
     */
    private $equipo;

    public function __construct()
    {
        $this->equipo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Equipo
    {
        return $this->user;
    }

    public function setUser(?Equipo $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEquipo(): Collection
    {
        return $this->equipo;
    }

    public function addEquipo(User $equipo): self
    {
        if (!$this->equipo->contains($equipo)) {
            $this->equipo[] = $equipo;
            $equipo->setEquipo($this);
        }

        return $this;
    }

    public function removeEquipo(User $equipo): self
    {
        if ($this->equipo->contains($equipo)) {
            $this->equipo->removeElement($equipo);
            // set the owning side to null (unless already changed)
            if ($equipo->getEquipo() === $this) {
                $equipo->setEquipo(null);
            }
        }

        return $this;
    }
}
