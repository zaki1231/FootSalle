<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "Le nom de l'equipe doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de l'equipe dépasse {{ limit }}"
     * )
     * @Groups({"group1"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"group1"})
     */
    private $matchGagne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"group1"})
     */
    private $matchNul;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"group1"})
     */
    private $matchPerdu;

    /**
     * @ORM\OneToMany(targetEntity=Joueur::class, mappedBy="idEquipe", cascade={"persist"})
     */
    private $joueurs;

    /**
     * @ORM\ManyToMany(targetEntity=Tournoi::class, inversedBy="equipes")
     */
    private $tournoi;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->tournoi = new ArrayCollection();
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

    /**
     * @return Collection|Tournoi[]
     */
    public function getTournoi(): Collection
    {
        return $this->tournoi;
    }

    public function addTournoi(tournoi $tournoi): self
    {
        if (!$this->tournoi->contains($tournoi)) {
            $this->tournoi[] = $tournoi;
        }

        return $this;
    }

    public function removeTournoi(tournoi $tournoi): self
    {
        if ($this->tournoi->contains($tournoi)) {
            $this->tournoi->removeElement($tournoi);
        }

        return $this;
    }
}
