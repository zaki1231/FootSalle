<?php

namespace App\Entity;

use App\Repository\TournoiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=TournoiRepository::class)
 * @Vich\Uploadable
 */
class Tournoi
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
     * @ORM\Column(type="datetime")
     */
    private $dateTournoi;

    /**
     * @ORM\Column(type="integer")
     */
    private $LimitEquipe;

    /**
     * @ORM\ManyToMany(targetEntity=Equipe::class, mappedBy="tournoi")
     */
    private $equipes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string| null
     */
    private $featuredImage;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File | null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     */
    private $contenu;


    public function __construct()
    {
        $this->equipes = new ArrayCollection();
    }

    /**
     * @param File/null $imageFile
     */
    public function setImageFile(?File $imageFile= null)
    {
         $this->imageFile = $imageFile;
    }

    /**
     * @return File/null 
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
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

    public function getDateTournoi(): ?\DateTimeInterface
    {
        return $this->dateTournoi;
    }

    public function setDateTournoi(\DateTimeInterface $dateTournoi): self
    {
        $this->dateTournoi = $dateTournoi;

        return $this;
    }

    public function getLimitEquipe(): ?int
    {
        return $this->LimitEquipe;
    }

    public function setLimitEquipe(int $LimitEquipe): self
    {
        $this->LimitEquipe = $LimitEquipe;

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
            $equipe->addTournoi($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipes->contains($equipe)) {
            $this->equipes->removeElement($equipe);
            $equipe->removeTournoi($this);
        }

        return $this;
    }

    /**
     * @return string/null 
     */
    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    /**
     * @param string/null $featuredImage
     */
    public function setFeaturedImage(?string $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}
