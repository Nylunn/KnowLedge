<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Column for the title of the formation
    #[ORM\Column]
    private ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

        // Column for the desc of the formation
    #[ORM\Column]
    private ?string $desc = null;

    public function getDesc(): ?string
    {
        return $this->desc;
    }


    // Adding image

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
