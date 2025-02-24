<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
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


    public function getTitle(): ?int
    {
        return $this->title;
    }

    //Column for the type of the lesson

     #[ORM\Column]
    private ?string $type = null;


    public function getType(): ?int
    {
        return $this->type;
    }

 
    //Column for the price of the lesson

     #[ORM\Column]
    private ?string $price = null;


    public function getPrice(): ?int
    {
        return $this->price;
    }
}
