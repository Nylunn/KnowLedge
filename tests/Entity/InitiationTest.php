<?php

namespace App\Tests\Entity;

use App\Entity\Initiation;
use PHPUnit\Framework\TestCase;

class InitiationTest extends TestCase
{
    private ?Initiation $initiation;

    protected function setUp(): void
    {
        $this->initiation = new Initiation();
    }

    public function testGetTitle()
    {
        //testing get title
        $this->assertNull($this->initiation->getTitle());
    }

    public function testGetType()
    {
        //testing gettype
        $this->assertNull($this->initiation->getType());
    }

    public function testGetPrice()
    {
        //testing getprice
        $this->assertNull($this->initiation->getPrice());
    }

    public function testIdIsNullInitially()
    {
        //testing the id is null on starting
        $this->assertNull($this->initiation->getId());
    }

    protected function tearDown(): void
    {
        //reset initiation
        $this->initiation = null;
    }
}
