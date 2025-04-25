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
   

    

  #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $purchaseAt = null;



    public function __construct()
    {
        $this->purchaseAt = new \DateTimeImmutable();
        
    }

        public function getPurchaseAt(): ?\DateTimeImmutable
    {
        return $this->purchaseAt;
    }

     


     #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    private ?string $article = null;

    public function getArticle(): ?string
    {
        return $this->article;
    }


      public function getPurcharser(?User $username): Collection
    {
        return $this->$username;
    }

 
     public function getPurchaseDate(): ?\DateTimeImmutable
    {
        return $this->purchaseAt;
    }

  #[ORM\Column]
    private ?string $Purchaser = null;

     #[ORM\Column]
    private ?string $title = null;

        public function getTitle(): ?string
    {
        return $this->title;
    }
    
     #[ORM\ManyToOne(inversedBy: 'order')]
     private ?User $username = null;

   

      public function getPurchaser(): ?User
    {
        return $this->username;
    }

    public function setPurchaser(?User $user): static
    {
        $this->username = $user;

        return $this;
    }


}
