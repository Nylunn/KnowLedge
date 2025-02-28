<?php

namespace App\Tests\Entity;

use App\Entity\Formation;
use App\Entity\Lesson;
use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    private Formation $formation;

    protected function setUp(): void
    {
        $this->formation = new Formation();
    }

    public function testInitialValues(): void
    {
        //Initial values for test
        $this->assertNull($this->formation->getId());
        $this->assertNull($this->formation->getTitle());
        $this->assertNull($this->formation->getDesc());
        $this->assertNull($this->formation->getImage());
        $this->assertNull($this->formation->getUpdatedAt());
        $this->assertNotNull($this->formation->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->formation->getCreatedAt());
        $this->assertEmpty($this->formation->getLessons());
    }

    public function testTitleAccessors(): void
    {
        //adding a title name for the test
        $title = 'Formation PHP';
        $reflection = new \ReflectionClass(Formation::class);
        $property = $reflection->getProperty('title');
        $property->setAccessible(true);
        $property->setValue($this->formation, $title);
        
        $this->assertEquals($title, $this->formation->getTitle());
    }

    public function testDescAccessors(): void
    {
        //adding a description for the test
        $desc = 'Description de la formation';
        
        $reflection = new \ReflectionClass(Formation::class);
        $property = $reflection->getProperty('desc');
        $property->setAccessible(true);
        $property->setValue($this->formation, $desc);
        
        $this->assertEquals($desc, $this->formation->getDesc());
    }

    public function testImageAccessors(): void
    {
        //adding an fake image for the test
        $image = 'formation.jpg';
        
        $this->formation->setImage($image);
        $this->assertEquals($image, $this->formation->getImage());
        
        $this->formation->setImage(null);
        $this->assertNull($this->formation->getImage());
    }

    public function testLessonManagement(): void
    {
        //Mocking the lesson
        $lesson1 = $this->createMock(Lesson::class);
        $lesson1->expects($this->any())
                ->method('setFormation')
                ->willReturnSelf();
        
        $lesson1->expects($this->any())
                ->method('getFormation')
                ->willReturnCallback(function() {
                    
                    return $this->formation;
                });
        
        $lesson2 = $this->createMock(Lesson::class);
        $lesson2->expects($this->any())
                ->method('setFormation')
                ->willReturnSelf();
        
        $lesson2->expects($this->any())
                ->method('getFormation')
                ->willReturn($this->formation);
        
        //testing adding lesson
        $this->formation->addLesson($lesson1);
        $this->formation->addLesson($lesson2);
        
        //verifying if 2 lessons are added
        $this->assertCount(2, $this->formation->getLessons());
        $this->assertTrue($this->formation->getLessons()->contains($lesson1));
        $this->assertTrue($this->formation->getLessons()->contains($lesson2));
        
        //testing we are not adding 2 time the same lesson
        $this->formation->addLesson($lesson1);
        $this->assertCount(2, $this->formation->getLessons());
        
        //testing removing lesson
        $this->formation->removeLesson($lesson1);
        $this->assertCount(1, $this->formation->getLessons());
        $this->assertFalse($this->formation->getLessons()->contains($lesson1));
        $this->assertTrue($this->formation->getLessons()->contains($lesson2));
    }
    
    public function testUpdatedAtSetter(): void
    {
        $this->assertNull($this->formation->getUpdatedAt());
        //testing the formation has been updated
        $this->formation->setUpdatedAt();
        
        $this->assertNotNull($this->formation->getUpdatedAt());
        $this->assertInstanceOf(\DateTime::class, $this->formation->getUpdatedAt());
    }
    
    public function testGetRoleForUser(): void
    {
       
        $reflection = new \ReflectionClass(Formation::class);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        
        $property->setValue($this->formation, 1);
        $this->assertEquals('ROLE_BASIC', $this->formation->getRoleForUser());
        
        $property->setValue($this->formation, 2);
        $this->assertEquals('ROLE_ADVANCED', $this->formation->getRoleForUser());
        
        $property->setValue($this->formation, 3);
        $this->assertEquals('ROLE_USER', $this->formation->getRoleForUser());
    }
}