<?php

namespace App\Entity;


use App\Repository\CampeonatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampeonatoRepository::class)
 * @ORM\Table(name="campeonatos")
 */
class Campeonato
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

  
    /**
    * @ORM\Column(type="string", length=20)
    */
    private $campeonatoNombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $juego;

    /**
     * @ORM\OneToMany(targetEntity="Prueba", mappedBy="campeonato")
     */
    private $pruebas;

    /**
     * One user has many participaciones. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Participacion", mappedBy="campeonato")
     */
    private $participantes;
    
    public function __construct() {
        $this->participantes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pruebas = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampeonatoNombre(): ?string
    {
        return $this->campeonatoNombre;
    }

    public function setCampeonatoNombre(string $campeonatoNombre): self
    {
        $this->campeonatoNombre = $campeonatoNombre;
        
        return $this;
    }

   

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getJuego(): ?string
    {
        return $this->juego;
    }

    public function setJuego(string $juego): self
    {
        $this->juego = $juego;

        return $this;
    }

    public function getPruebas()
    {
        return $this->pruebas;
    }

    public function setPruebas($pruebas): self
    {
        $this->pruebas = $pruebas;

        return $this;
    }

    public function getParticipantes()
    {
        return $this->participantes;
    }

    public function setParticipantes($participantes): self
    {
        $this->participantes = $participantes;

        return $this;
    }

    public function addPrueba(Prueba $prueba): self
    {
        if (!$this->pruebas->contains($prueba)) {
            $this->pruebas[] = $prueba;
            $prueba->setCampeonato($this);
        }

        return $this;
    }

    public function removePrueba(Prueba $prueba): self
    {
        if ($this->pruebas->contains($prueba)) {
            $this->pruebas->removeElement($prueba);
            // set the owning side to null (unless already changed)
            if ($prueba->getCampeonato() === $this) {
                $prueba->setCampeonato(null);
            }
        }

        return $this;
    }

    public function addParticipante(Participacion $participante): self
    {
        if (!$this->participantes->contains($participante)) {
            $this->participantes[] = $participante;
            $participante->setCampeonato($this);
        }

        return $this;
    }

    public function removeParticipante(Participacion $participante): self
    {
        if ($this->participantes->contains($participante)) {
            $this->participantes->removeElement($participante);
            // set the owning side to null (unless already changed)
            if ($participante->getCampeonato() === $this) {
                $participante->setCampeonato(null);
            }
        }

        return $this;
    }
}
