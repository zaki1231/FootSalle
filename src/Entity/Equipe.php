<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchGagne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchNul;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchPerdu;

    /**
     * @ORM\OneToMany(targetEntity=Joueur::class, mappedBy="idEquipe")
     */
    private $joueurs;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMatchGagne(): ?int
    {
        return $this->matchGagne;
    }

    public function setMatchGagne(?int $matchGagne): self
    {
        $this->matchGagne = $matchGagne;

        return $this;
    }

    public function getMatchNul(): ?int
    {
        return $this->matchNul;
    }

    public function setMatchNul(?int $matchNul): self
    {
        $this->matchNul = $matchNul;

        return $this;
    }

    public function getMatchPerdu(): ?int
    {
        return $this->matchPerdu;
    }

    public function setMatchPerdu(?int $matchPerdu): self
    {
        $this->matchPerdu = $matchPerdu;

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setIdEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->contains($joueur)) {
            $this->joueurs->removeElement($joueur);
            // set the owning side to null (unless already changed)
            if ($joueur->getIdEquipe() === $this) {
                $joueur->setIdEquipe(null);
            }
        }

        return $this;
    }
}
