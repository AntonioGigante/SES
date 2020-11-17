<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
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
     * @ORM\Column(type="string", length=30)
     */
    private $director;

    /**
     * @ORM\Column(type="array")
     */
    private $miembros = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competicionesapuntadas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competicionesganadas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partidos;

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

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getMiembros(): ?array
    {
        return $this->miembros;
    }

    public function setMiembros(array $miembros): self
    {
        $this->miembros = $miembros;

        return $this;
    }

    public function getCompeticionesapuntadas(): ?int
    {
        return $this->competicionesapuntadas;
    }

    public function setCompeticionesapuntadas(?int $competicionesapuntadas): self
    {
        $this->competicionesapuntadas = $competicionesapuntadas;

        return $this;
    }

    public function setCompeticionesganadas(?int $competicionesganadas): self
    {
        $this->competidionesganadas = $competicionesganadas;

        return $this;
    }

    public function setPartidos(?int $partidos): self
    {
        $this->partidos = $partidos;

        return $this;
    }

    public function getCompeticionesganadas(): ?int
    {
        return $this->competicionesganadas;
    }

    public function getPartidos(): ?int
    {
        return $this->partidos;
    }
}

