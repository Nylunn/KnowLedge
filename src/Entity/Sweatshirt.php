<?php

namespace App\Entity;

use App\Repository\SweatshirtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SweatshirtRepository::class)]
class Sweatshirt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    
    #[ORM\Column]
    private ?int $id = null;



    public function getId(): ?int
    {
        return $this->id;
    }
    
    #[ORM\Column]
    private ?string $size = null;



    public function getSize(): ?string
    {
        return $this->size;
    }

    #[ORM\Column]
    private ?string $price = null;

    public function getPrice(): ?string
    {
        return $this->price;
    }

    #[ORM\Column]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

}
