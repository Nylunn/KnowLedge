<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
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
    private ?int $article = null;



    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $purchaseDate = null;


    /**
     * @var Collection<int, Lesson>
     */
    #[ORM\OneToOne(targetEntity: User::class, mappedBy: 'Order')]
    private Collection $user;

    public function __construct()
    {
        $this->purchaseDate = new \DateTimeImmutable();
        $this->user = new ArrayCollection();
    }


    /**
     * @return Collection<int, Lesson>
     */

    public function getArticle(): Collection
    {
        return $this->article;
    }


      public function getPurcharser(): Collection
    {
        return $this->user;
    }

 
     public function getPurchaseDate(): ?\DateTimeImmutable
    {
        return $this->purchaseDate;
    }



     #[ORM\Column]
    private ?string $title = null;

        public function getTitle(): ?string
    {
        return $this->title;
    }
    
     #[ORM\Column]
    private ?string $Purchaser = null;



}
