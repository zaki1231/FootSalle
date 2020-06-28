<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
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
}
