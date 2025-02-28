<?php

namespace App\Tests\Form;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Test\TypeTestCase;

class RegistrationFormTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        //creating form with valide data
        $formData = [
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => [
                'first' => 'password123',
                'second' => 'password123',
            ],
        ];

        $user = new User();

        $form = $this->factory->create(RegistrationFormType::class, $user);

        //submit data to form
        $form->submit($formData);

        //testing the form is valid
        $this->assertTrue($form->isValid());

        //testing the user data is up to date
        $this->assertEquals($formData['email'], $user->getEmail());
        $this->assertEquals($formData['username'], $user->getUsername());
        
        //testing user password is here
        $this->assertNotNull($user->getPassword());
    }

    public function testSubmitInvalidData(): void
    {
        //testing with wrong value
        $formData = [
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => [
                'first' => 'password123',
                'second' => 'differentpassword',
            ],
        ];

        $user = new User();

        //creating the form        
        $form = $this->factory->create(RegistrationFormType::class, $user);

        //submit wrong value to form
        $form->submit($formData);

        //testing the form is wrong
        $this->assertFalse($form->isValid());

        
        $this->assertNull($user->getPassword());
    }
}
