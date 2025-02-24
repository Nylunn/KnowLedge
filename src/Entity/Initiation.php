<?php

namespace App\Entity;

use App\Repository\InitiationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InitiationRepository::class)]
class Initiation
{
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

 
    //Column for the price of the cursus

     #[ORM\Column]
    private ?string $price = null;


    public function getPrice(): ?string
    {
        return $this->price;
    }
}
