<?php

namespace App\Entity;

use App\Repository\TournoiRepository;
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
     * @ORM\Column(type="datetime", name="date_tournoi")
     * @var \DateTime
     */
    private $dateTournoi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $featuredImage;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     * @var \DateTime
     */
    private $updatedAt;
    

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featuredImage")
     * @var File
     */
    private $imageFile;
   
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

    /**
     * @return \DateTime
     */
    public function getDateTournoi()
    {
        return $this->dateTournoi;
    }

    /**
     * @return \DateTime
     */
    public function setDateTournoi(\DateTime $dateTournoi)
    {
        $this->dateTournoi = $dateTournoi;
    }

    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(string $featuredImage)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

}
