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
    //taille XS
    #[ORM\Column]
    private ?string $sizeXS = null;



    public function getSizeXS(): ?string
    {
        return $this->sizeXS;
    }
    //taille S
 #[ORM\Column]
    private ?string $sizeS = null;



    public function getSizeS(): ?string
    {
        return $this->sizeS;
    }

    //taille M
     #[ORM\Column]
    private ?string $sizeM = null;



    public function getSizeM(): ?string
    {
        return $this->sizeM;
    }
    //taille L
 #[ORM\Column]
    private ?string $sizeL = null;



    public function getSizeL(): ?string
    {
        return $this->sizeL;
    }
    //taille XL

     #[ORM\Column]
    private ?string $sizeXL = null;



    public function getSizeXL(): ?string
    {
        return $this->sizeXL;
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
