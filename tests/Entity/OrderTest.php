<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\User;
use App\Entity\Lesson;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private Order $order;

    protected function setUp(): void
    {
        $this->order = new Order();
    }

    public function testInitialValues(): void
    {
        //adding initial value
        $this->assertNull($this->order->getId());
        $this->assertNull($this->order->getTitle());
        
        //testing the purchase date
        $this->assertNotNull($this->order->getPurchaseDate());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->order->getPurchaseDate());
        
        $this->assertInstanceOf(Collection::class, $this->order->getPurcharser());
        $this->assertCount(0, $this->order->getPurcharser());
    }

    public function testTitleAccessors(): void
    {
        //adding a title for the test
        $title = 'Commande 1';
        
        $reflection = new \ReflectionClass(Order::class);
        $property = $reflection->getProperty('title');
        $property->setAccessible(true);
        $property->setValue($this->order, $title);
        
        $this->assertEquals($title, $this->order->getTitle());
    }

    public function testArticleProperty(): void
    {
        
        $article = 42; //supposing its an article id
        
        $reflection = new \ReflectionClass(Order::class);
        $property = $reflection->getProperty('article');
        $property->setAccessible(true);
        $property->setValue($this->order, $article);
        
        $this->assertEquals($article, $property->getValue($this->order));
    }

    public function testPurchaserProperty(): void
    {
        //adding a purchaser name for the test
        $purchaser = 'John Doe';
        
        $reflection = new \ReflectionClass(Order::class);
        $property = $reflection->getProperty('Purchaser');
        $property->setAccessible(true);
        $property->setValue($this->order, $purchaser);
        
        $this->assertEquals($purchaser, $property->getValue($this->order));
    }

    public function testUserCollection(): void
    {
        $this->assertInstanceOf(Collection::class, $this->order->getPurcharser());
        
        $user = $this->createMock(User::class);
        
        $reflection = new \ReflectionClass(Order::class);
        $property = $reflection->getProperty('user');
        $property->setAccessible(true);
        
        $userCollection = $property->getValue($this->order);
        $userCollection->add($user);
        
        $this->assertCount(1, $this->order->getPurcharser());
        $this->assertTrue($this->order->getPurcharser()->contains($user));
    }
    
    public function testPurchaseDateImmutability(): void
    {
        //testing the date of the purchase
        $originalDate = $this->order->getPurchaseDate();
        
        usleep(1000);
        
        $this->assertSame($originalDate, $this->order->getPurchaseDate());
    }
}