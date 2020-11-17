<?php

namespace App\Entity;

use App\Repository\ParticipacionRepository;
use Doctrine\ORM\Mapping as ORM; 

/**
 * @ORM\Entity(repositoryClass=ParticipacionRepository::class)
 * @ORM\Table(name="participaciones")
 */
class Participacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * Many participaciones have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="participaciones")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;
    
    /**
     * Many participaciones have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Campeonato", inversedBy="participantes")
     * @ORM\JoinColumn(name="campeonato", referencedColumnName="id")
     */
    private $campeonato;

    public function __construct() {
        
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
