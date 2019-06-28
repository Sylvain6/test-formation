<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration_hour;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Assert\GreaterThan("today")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classroom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_student;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participation", mappedBy="formation")
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="formation")
     */
    private $former;

    public function __construct($subject, $duration_hour, $date, $classroom, $nb_student, User $former)
    {
        $this->subject = $subject;
        $this->duration_hour = $duration_hour;
        $this->date = $date;
        $this->classroom = $classroom;
        $this->nb_student = $nb_student;
        $this->participations = new ArrayCollection();
        $this->setFormer($former);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDurationHour(): ?int
    {
        return $this->duration_hour;
    }

    public function setDurationHour(int $duration_hour): self
    {
        $this->duration_hour = $duration_hour;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClassroom(): ?string
    {
        return $this->classroom;
    }

    public function setClassroom(string $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function getNbStudent(): ?int
    {
        return $this->nb_student;
    }

    public function setNbStudent(int $nb_student): self
    {
        $this->nb_student = $nb_student;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->addFormation($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            $participation->removeFormation($this);
        }

        return $this;
    }

    public function getFormer(): ?User
    {
        return $this->former;
    }

    public function setFormer(User $former): self
    {
        $this->former = $former;

        return $this;
    }

    public function isValid(): bool
    {
        if (is_string($this->subject)
         && is_integer($this->duration_hour) && $this->date > date("Y-m-d H:i:s")
          && is_integer($this->classroom) && is_integer($this->nb_student)
           && $this->former instanceof User ){
            return true;
        }
        return false;
    }
}
