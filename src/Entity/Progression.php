<?php

namespace App\Entity;

use App\Repository\ProgressionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressionRepository::class)]
class Progression
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

      #[ORM\ManyToOne]
    private User $user;

    #[ORM\ManyToOne]
    private Chapter $chapter;

    #[ORM\Column]
    private bool $isCompleted = false;
}
