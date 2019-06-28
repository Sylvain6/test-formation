<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    protected $user;
    protected $role;
    protected $formation;

    public function setUp() {
        $this->role = new Role("former");
        $this->user = new User("coutrot","sylvain.coutrot@hotmail.fr","sylvain",$this->role);
    }
    
    /** @test */
    public function add_formation(){
        $this->formation = new Formation("Mathematics",2,date("Y-m-d H:i:s", strtotime("+3 days")),102,0,$this->user);

        $this->assertEquals(true, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_date(){
        $this->formation = new Formation("Mathematics",2,date("Y-m-d H:i:s", strtotime("-3 days")),102,0,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_user(){
        $this->formation = new Formation("Mathematics",2,date("Y-m-d H:i:s", strtotime("-3 days")),102,0,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_format_subject(){
        $this->formation = new Formation(null,2,date("Y-m-d H:i:s", strtotime("-3 days")),102,0,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_format_hours(){
        $this->formation = new Formation("French",null,date("Y-m-d H:i:s", strtotime("-3 days")),102,0,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_format_classroom(){
        $this->formation = new Formation("French",2,date("Y-m-d H:i:s", strtotime("-3 days")),null,0,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }

    /** @test */
    public function formation_bad_format_nb_person(){
        $this->formation = new Formation("French",2,date("Y-m-d H:i:s", strtotime("-3 days")),102,null,$this->user);

        $this->assertEquals(false, $this->formation->isValid());
    }
} 