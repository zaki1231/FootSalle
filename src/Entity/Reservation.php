<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    
    /**
     * @var int 
     * 
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
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 80,
     *      minMessage = "Votre nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom dépasse {{ limit }}"
     * )
     */
    private $prenom;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{10}$/")
     */
    private $numeroTel;

    /**
     * @ORM\Column(type="date")
     */
    private $dateReservation;

    /**
     * @ORM\Column(type="time")
     */
    private $timeReservation;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(string $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getTimeReservation(): ?\DateTimeInterface
    {
        return $this->timeReservation;
    }

    public function setTimeReservation(\DateTimeInterface $timeReservation): self
    {
        $this->timeReservation = $timeReservation;

        return $this;
    }
   
    
    


  
}
