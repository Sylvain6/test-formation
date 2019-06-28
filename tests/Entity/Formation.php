<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    protected $user;
    protected $role;

    /** @test */
    public function add_formation(){
        $this->role = new Role(3, "student");
        $this->user = new User("sylvain.coutrot@hotmail.fr","sylvain",$this->role);
        $this->assertEquals(true, $this->exchange->save());
    }
} 