<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="equipos")
 * @ORM\Entity(repositoryClass=EquipoRepository::class)
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(
     *      min = 7,
     *      max = 20,
     *      minMessage = "El nombre del equipo debe contener al menos {{ limit }} caracteres",
     *      maxMessage = "El nombre del equipo no debe contener más de  {{ limit }} caracteres",
     *      allowEmptyString = false
     * )
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $director;

    

    /**
     * @ORM\OneToMany(targetEntity=Miembros::class, mappedBy="user")
     */
    private $integrantes;

    public function __construct()
    {
        $this->integrantes = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

 

    /**
     * @return Collection|Miembros[]
     */
    public function getIntegrantes(): Collection
    {
        return $this->integrantes;
    }

    public function addIntegrante(Miembros $integrante): self
    {
        if (!$this->integrantes->contains($integrante)) {
            $this->integrantes[] = $integrante;
            $integrante->setUser($this);
        }

        return $this;
    }

    public function removeIntegrante(Miembros $integrante): self
    {
        if ($this->integrantes->contains($integrante)) {
            $this->integrantes->removeElement($integrante);
            // set the owning side to null (unless already changed)
            if ($integrante->getUser() === $this) {
                $integrante->setUser(null);
            }
        }

        return $this;
    }

   
}

