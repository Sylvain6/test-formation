<?php

namespace App\Entity;

use App\Entity\Participation;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class UserTest extends TestCase
{
    private $role_student;

    public function setUp() {
        $this->role_student = new Role('Student');
    }

    /**
     * @covers User::isValid
     */
    public function testIsValidNominal()
    {
        $user = new User( 'dumont.antoine27@gmail.com', 'Antoine', 'Dumont', $this->role_student );
        $result = $user->isValid();
        $this->assertTrue($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseEmailFormat()
    {
        $user = new User( 'guillaume.delamare.com', 'Guillaume', 'Dupuit', $this->role_student );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseFirstnameIsInvalid()
    {
        $user = new User( 'guillaume.delamare@gmail.com', null, 'Coutrot', $this->role_student );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseNameIsInvalid()
    {
        $user = new User( 'guillaume.delamare@gmail.com', 'Guillaupme', null, $this->role_student );
        $result = $user->isValid();
        $this->assertFalse($result);
    }




}