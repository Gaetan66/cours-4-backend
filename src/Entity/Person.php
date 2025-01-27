<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $email;

    #[ORM\ManyToOne(targetEntity: Building::class, inversedBy: 'residents')]
    private Building $building;

    #[ORM\ManyToOne(inversedBy: 'residents')]
    private ?Building $residents = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResidents(): ?Building
    {
        return $this->residents;
    }

    public function setResidents(?Building $residents): static
    {
        $this->residents = $residents;

        return $this;
    }
}
