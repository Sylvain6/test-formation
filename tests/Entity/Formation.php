<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    protected $user;
    protected $role;

    /** @test */
    public function add_formation(){
        $this->role = new Role("student");
        $this->user = new User("coutrot","sylvain.coutrot@hotmail.fr","sylvain",null,$this->role);
        $this->assertEquals(true, $this->exchange->save());
    }
} 