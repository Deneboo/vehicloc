<?php

namespace App\Entity;

use App\Enum\CarMotor;
use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Type(
        type: 'numeric',
        message: 'Veuillez saisir un nombre.'
    )]
    private ?float $monthly_price = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\Type(
        type: 'numeric',
        message: 'Veuillez saisir un nombre.'
    )]
    private ?float $daily_price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 9)]
    private ?int $places = null;

    #[ORM\Column(length: 255, enumType: CarMotor::class)]
    #[Assert\NotBlank]
    private ?CarMotor $motor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthly_price;
    }

    public function setMonthlyPrice(float $monthly_price): static
    {
        $this->monthly_price = $monthly_price;

        return $this;
    }

    public function getDailyPrice(): ?float
    {
        return $this->daily_price;
    }

    public function setDailyPrice(float $daily_price): static
    {
        $this->daily_price = $daily_price;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function getMotor(): ?CarMotor
    {
        return $this->motor;
    }

    public function setMotor(CarMotor $motor): static
    {
        $this->motor = $motor;

        return $this;
    }
}
