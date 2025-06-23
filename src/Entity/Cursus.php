<?php

namespace App\Entity;

use App\Repository\CursusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CursusRepository::class)]
class Cursus
{


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

        //Column for the title of the lesson

     #[ORM\Column]
    private ?string $title = null;


    public function getTitle(): ?string
    {
        return $this->title;
    }

    //Column for the type of the lesson

     #[ORM\Column]
    private ?string $type = null;


    public function getType(): ?string
    {
        return $this->type;
    }


         #[ORM\Column]
    private ?string $image = null;


    public function getImage(): ?string
    {
        return $this->image;
    }

 

     #[ORM\Column]
    private ?string $price = null;

     #[ORM\ManyToOne(inversedBy: 'Cursus')]
     private ?Formation $formation = null;

    //Column for the price of the lesson

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }



public function setType(?string $type): self
{
    $this->type = $type;
    return $this;
}


}
