<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinTable;

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

    // Column for the description of the formation
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
    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updatedAt = null;

    /**
     * @var Collection<int, Lesson>
     */
    #[ORM\OneToMany(targetEntity: Lesson::class, mappedBy: 'formation')]
    private Collection $lessons;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->lessons = new ArrayCollection();
    }


    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
            $lesson->setFormation($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getFormation() === $this) {
                $lesson->setFormation(null);
            }
        }

        return $this;
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

}
