<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, \Serializable, EquatableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="string", length=180, unique=true)  
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $victorias;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competicionesapuntado;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competicionesganadas;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/",
     *     match=false,
     *     message="La contraseña debe contener entre 8 y 16 caracteres, 1 mayuscula y 1 minuscula"
     * )
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "El nombre de usuario debe contener al menos {{ limit }} caracteres",
     *      maxMessage = "El nombre de usuario no debe contener más de  {{ limit }} caracteres",
     *      allowEmptyString = false
     * )
     */
    private $username;

    /**
     * One user has many participaciones. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Participacion", mappedBy="user")
     */
    private $participaciones;

    /**
     * @ORM\ManyToOne(targetEntity=Miembros::class, inversedBy="equipo")
     */
    private $equipo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;
    
   
    public function __construct() {
        $this->participaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
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

    public function getVictorias(): ?int
    {
        return $this->victorias;
    }

    public function setVictorias(int $victorias)
    {
        $this->victorias = $victorias;
    }

    public function getCompeticionesApuntado(): ?int
    {
        return $this->competicionesapuntado;
    }

    public function setCompeticionesApuntado(int $competicionesapuntado)
    {
        $this->competicionesapuntado = $competicionesapuntado;
    }

    public function getCompeticionesGanadas(): ?int
    {
        return $this->competicionesganadas;
    }

    public function setCompeticionesGanadas(int $competicionesganadas)
    {
        $this->competicionesganadas = $competicionesganadas;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

   

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // ver la sección salt debajo
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // ver la sección salt debajo
            // $this->salt
        ) = unserialize($serialized);
    }

    public function isEqualTo(UserInterface $user)
    {
        error_log("IS EQUALS TO 0".$this->username);
        
        if (!$user instanceof User) {
            return false;
        }
        error_log("IS EQUALS TO 1");
        
        if ($this->password !== $user->getPassword()) {
            return false;
        }
        error_log("IS EQUALS TO 2 ".$user->getEmail());
        /*if ($this->salt !== $user->getSalt()) {
            return false;
        }*/
        
        if ($this->username !== $user->getUsername()) {
            return false;
        }
        /*if ($this->username !== $user->getUsername()) {
            return false;
        }*/
        error_log("IS EQUALS TO 3 true");
        return true;
    }
    
    
    /**
     * @return Collection|Participacion[]
     */
    public function getParticipaciones(): Collection
    {
        return $this->participaciones;
    }

    public function addParticipacion(Participacion $participacion): self
    {
        if (!$this->participaciones->contains($participacion)) {
            $this->participaciones[] = $participacion;
        }

        return $this;
    }

    public function removeParticipacion(Participacion $participacion): self
    {
        if ($this->participaciones->contains($participacion)) {
            $this->participaciones->removeElement($participacion);
        }

        return $this;
    }

    public function addParticipacione(Participacion $participacione): self
    {
        if (!$this->participaciones->contains($participacione)) {
            $this->participaciones[] = $participacione;
            $participacione->setUser($this);
        }

        return $this;
    }

    public function removeParticipacione(Participacion $participacione): self
    {
        if ($this->participaciones->contains($participacione)) {
            $this->participaciones->removeElement($participacione);
            // set the owning side to null (unless already changed)
            if ($participacione->getUser() === $this) {
                $participacione->setUser(null);
            }
        }

        return $this;
    }

    public function getEquipo(): ?Miembros
    {
        return $this->equipo;
    }

    public function setEquipo(?Miembros $equipo): self
    {
        $this->equipo = $equipo;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
