<?php

namespace App\Entity;

use App\Repository\InitiationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InitiationRepository::class)]
class Initiation
{
    
    // Column for the date of creation of the cursus

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updatedAt = null;


      public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();

    }

        public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    
    // Column for the date of the up to date cursus

      public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

      #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime(); 
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    //Column for the title of the cursus

     #[ORM\Column]
    private ?string $title = null;


    public function getTitle(): ?string
    {
        return $this->title;
    }

    //Column for the type of the cursus

     #[ORM\Column]
    private ?string $type = null;


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
{
    $this->type = $type;
    return $this;
}

 
    //Column for the price of the cursus

     #[ORM\Column]
    private ?string $price = null;


    public function getPrice(): ?string
    {
        return $this->price;
    }

    // Column for the image of the cursus

             #[ORM\Column]
    private ?string $image = null;


    public function getImage(): ?string
    {
        return $this->image;
    }


    // Column for the formation_id

      #[ORM\ManyToOne(inversedBy: 'Initiation')]
     private ?Formation $formation = null;

         public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

}
