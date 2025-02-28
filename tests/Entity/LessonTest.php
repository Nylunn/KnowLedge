<?php

namespace App\Tests\Entity;

use App\Entity\Lesson;
use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class LessonTest extends TestCase
{
    private Lesson $lesson;

    protected function setUp(): void
    {
        $this->lesson = new Lesson();
    }

    public function testInitialValues(): void
    {
        $this->assertNull($this->lesson->getId());
        $this->assertNull($this->lesson->getTitle());
        $this->assertNull($this->lesson->getType());
        $this->assertNull($this->lesson->getImage());
        $this->assertNull($this->lesson->getPrice());
        $this->assertNull($this->lesson->getFormation());
        $this->assertNull($this->lesson->getUpdatedAt());
        $this->assertNotNull($this->lesson->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->lesson->getCreatedAt());
    }

    public function testTitleAccessors(): void
    {
        $title = 'Introduction à PHP';
        
     
        $reflection = new \ReflectionClass(Lesson::class);
        $property = $reflection->getProperty('title');
        $property->setAccessible(true);
        $property->setValue($this->lesson, $title);
        
        $this->assertEquals($title, $this->lesson->getTitle());
    }

    public function testTypeAccessors(): void
    {
        $type = 'Video';
        
        $this->lesson->setType($type);
        $this->assertEquals($type, $this->lesson->getType());
        
        $newType = 'Text';
        $this->lesson->setType($newType);
        $this->assertEquals($newType, $this->lesson->getType());
        
        $this->lesson->setType(null);
        $this->assertNull($this->lesson->getType());
    }

    public function testImageAccessors(): void
    {
        $image = 'lesson.jpg';
        
        $reflection = new \ReflectionClass(Lesson::class);
        $property = $reflection->getProperty('image');
        $property->setAccessible(true);
        $property->setValue($this->lesson, $image);
        
        $this->assertEquals($image, $this->lesson->getImage());
    }

    public function testPriceAccessors(): void
    {
        $price = '19.99';
        
        $reflection = new \ReflectionClass(Lesson::class);
        $property = $reflection->getProperty('price');
        $property->setAccessible(true);
        $property->setValue($this->lesson, $price);
        
        $this->assertEquals($price, $this->lesson->getPrice());
    }

    public function testFormationAccessors(): void
    {
        $formation = $this->createMock(Formation::class);
        
        $this->lesson->setFormation($formation);
        $this->assertSame($formation, $this->lesson->getFormation());
        
        $this->lesson->setFormation(null);
        $this->assertNull($this->lesson->getFormation());
    }
    
    public function testUpdatedAtSetter(): void
    {
        $this->assertNull($this->lesson->getUpdatedAt());
        
        $this->lesson->setUpdatedAt();
        
        $this->assertNotNull($this->lesson->getUpdatedAt());
        $this->assertInstanceOf(\DateTime::class, $this->lesson->getUpdatedAt());
        
        $now = new \DateTime();
        $diff = $now->getTimestamp() - $this->lesson->getUpdatedAt()->getTimestamp();
        $this->assertLessThanOrEqual(2, $diff);
    }
    
    public function testFluentInterfaces(): void
    {
        $formation = $this->createMock(Formation::class);
        
        $this->assertSame($this->lesson, $this->lesson->setFormation($formation));
        $this->assertSame($this->lesson, $this->lesson->setType('Video'));
    }
}