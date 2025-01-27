<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingRepository::class)]
class Building
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    /**
     * @var Collection<int, Person>
     */
    #[ORM\OneToMany(mappedBy: 'residents', targetEntity: Person::class)]
    private Collection $residents;

    public function __construct()
    {
        $this->residents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getResidents(): Collection
    {
        return $this->residents;
    }

    public function addResident(Person $resident): static
    {
        if (!$this->residents->contains($resident)) {
            $this->residents->add($resident);
            $resident->setResidents($this);
        }

        return $this;
    }

    public function removeResident(Person $resident): static
    {
        if ($this->residents->removeElement($resident)) {
            // set the owning side to null (unless already changed)
            if ($resident->getResidents() === $this) {
                $resident->setResidents(null);
            }
        }

        return $this;
    }
}
