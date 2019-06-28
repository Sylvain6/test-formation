<?php

use App\Entity\Participation;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class Users extends TestCase
{

    public function __construct()
    {
        $role_organiser = new Role( 1, 'Organizer' );
        $role_teacher = new Role( 2, 'Teacher' );
        $role_student = new Role( 3, 'Strudent' );

        $participation = new Participation();

        $organism = new User( 'dumont.antoine27@gmail.com', 'Antoine', $role_organiser );
        $teacher = new User( 'sylvain.coutrot@gmail.com', 'Sylvain', $role_teacher );
        $student = new User( 'guillaume.delamare@gmail.com', 'Guillaume', $role_student );
    }

    /**
     * @covers User::isValid
     */
    public function testIsValidNominal()
    {
        $user = new User( 'dumont.antoine27@gmail.com', 'Antoine', 2 );
        $result = $user->isValid();
        $this->assertTrue($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseEmailFormat()
    {
        $user = new User( 'guillaume.delamare.com', 'Guillaume', 3 );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseFirstnameIsInvalid()
    {
        $user = new User( 'guillaume.delamare@gmail.com', '', 3 );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

    /**
     * @covers User::isValid
     */
    public function testIsNotValidBecauseRoleIsInvalid()
    {
        $user = new User( 'guillaume.delamare@gmail.com', 'Guillaume', 0 );
        $result = $user->isValid();
        $this->assertFalse($result);
    }

}