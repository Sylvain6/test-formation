<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 * @UniqueEntity(
 *     fields={"participant", "formation"},
 *     errorPath="participant",
 *     message="This participant is already participating to that formation."
 * )
 */
class Participation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="participations")
     */
    private $participant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formation", inversedBy="participations")
     */
    private $formation;

    public function __construct()
    {
        $this->participant = new ArrayCollection();
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participant->contains($participant)) {
            $this->participant->removeElement($participant);
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addParticipation(Formation $formation, User $participant): self
    {
        if ($formation->date > date("Y-m-d H:i:s")) {
            if (!$this->participant->contains($participant)) {
                $this->participant[] = $participant;
            }
            if (!$this->formation->contains($formation)) {
                $this->formation[] = $formation;
            }
            return $this;
        } else {
            throw new \Exception('This formation already passed');
        }

    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->contains($formation)) {
            $this->formation->removeElement($formation);
        }

        return $this;
    }
}
