<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testInitialValues(): void
    {
        $this->assertNull($this->user->getId());
        $this->assertNull($this->user->getEmail());
        $this->assertNull($this->user->getUsername());
        $this->assertNull($this->user->getPassword());
        $this->assertFalse($this->user->isVerified());
        $this->assertNull($this->user->getUpdatedAt());
        $this->assertNotNull($this->user->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->user->getCreatedAt());
        
        //verifying the user have user role
        $this->assertContains('ROLE_USER', $this->user->getRoles());
        $this->assertCount(1, $this->user->getRoles());
    }

    public function testEmailAccessors(): void
    {
        $email = 'user@example.com';
        
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
        $this->assertEquals($email, $this->user->getUserIdentifier());
    }

    public function testUsernameAccessors(): void
    {
        $username = 'john_doe';
        
        $this->user->setUsername($username);
        $this->assertEquals($username, $this->user->getUsername());
    }

    public function testPasswordAccessors(): void
    {
        $password = 'hashed_password';
        
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());
    }

    public function testRolesAccessors(): void
    {
        //by default the user have role user
        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
        
        //Adding role for test
        $roles = ['ROLE_ADMIN', 'ROLE_MANAGER'];
        $this->user->setRoles($roles);
        
        //verifying by default user have role user
        $expectedRoles = array_unique(array_merge($roles, ['ROLE_USER']));
        $this->assertEquals($expectedRoles, $this->user->getRoles());
        
        //verifying the double role are deleting
        $this->user->setRoles(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_ADMIN']);
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $this->user->getRoles());
    }

    public function testIsVerifiedAccessors(): void
    {
        // by default the user is not verified
        $this->assertFalse($this->user->isVerified());
        
        $this->user->setIsVerified(true);
        $this->assertTrue($this->user->isVerified());
        
        $this->user->setIsVerified(false);
        $this->assertFalse($this->user->isVerified());
    }
    
    public function testUpdatedAtSetter(): void
    {
        $this->assertNull($this->user->getUpdatedAt());
        
        $this->user->setUpdatedAt();
        
        $this->assertNotNull($this->user->getUpdatedAt());
        $this->assertInstanceOf(\DateTime::class, $this->user->getUpdatedAt());
    }
    
    public function testEraseCredentials(): void
    {
        $this->user->eraseCredentials();
        $this->assertTrue(true);
    }

    public function testUserInterface(): void
    {
        $this->assertInstanceOf(\Symfony\Component\Security\Core\User\UserInterface::class, $this->user);
        $this->assertInstanceOf(\Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface::class, $this->user);
    }
}