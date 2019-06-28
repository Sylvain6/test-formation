<?php

namespace App\Entity;

use App\Entity\Participation;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class UserTest extends TestCase
{

    /**
     * @covers User::isValid
     */
    public function testIsValidNominal()
    {
        $role_student = new Role( 3, 'Student' );
        $user = new User( 'dumont.antoine27@gmail.com', 'Antoine', $role_student );
        $result = $user->isValid();
        $this->assertTrue($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseEmailFormat()
    {
        $role_student = new Role( 3, 'Student' );
        $user = new User( 'guillaume.delamare.com', 'Guillaume', $role_student );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseFirstnameIsInvalid()
    {
        $role_student = new Role( 3, 'Student' );
        $user = new User( 'guillaume.delamare@gmail.com', '', $role_student );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseRoleIsInvalid()
    {
        $role_false = new Role( 7, 'false');
        $user = new User( 'guillaume.delamare@gmail.com', 'Guillaume', $role_false );
        $result = $user->isValid();
        $this->assertFalse($result);
    }



}