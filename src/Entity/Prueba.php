<?php

namespace App\Entity;

use App\Repository\PruebaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PruebaRepository::class)
 * @ORM\Table(name="pruebas")
 */
class Prueba
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many pruebas have one campeonato. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Campeonato", inversedBy="pruebas")
     * @ORM\JoinColumn(name="campeonato", referencedColumnName="id")
     */
    private $campeonato;
    
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prueba;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getPrueba(): ?string
    {
        return $this->prueba;
    }

    public function setPrueba(string $prueba): self
    {
        $this->prueba = $prueba;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCampeonato(): ?Campeonato
    {
        return $this->campeonato;
    }

    public function setCampeonato(?Campeonato $campeonato): self
    {
        $this->campeonato = $campeonato;

        return $this;
    }
}
