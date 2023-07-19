<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $area = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $electricity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $internet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sunshineRate = null;

    #[ORM\Column(nullable: true)]
    private ?float $temperatureAverage = null;

    #[ORM\Column(nullable: true)]
    private ?int $cost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $language = null;

    #[ORM\Column(nullable: true)]
    private ?int $demography = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $housing = null;

    #[ORM\Column]
    private ?int $timezone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $environment = null;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    private ?Country $country = null;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Image::class)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(?int $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getElectricity(): ?string
    {
        return $this->electricity;
    }

    public function setElectricity(?string $electricity): static
    {
        $this->electricity = $electricity;

        return $this;
    }

    public function getInternet(): ?string
    {
        return $this->internet;
    }

    public function setInternet(?string $internet): static
    {
        $this->internet = $internet;

        return $this;
    }

    public function getSunshineRate(): ?string
    {
        return $this->sunshineRate;
    }

    public function setSunshineRate(?string $sunshineRate): static
    {
        $this->sunshineRate = $sunshineRate;

        return $this;
    }

    public function getTemperatureAverage(): ?float
    {
        return $this->temperatureAverage;
    }

    public function setTemperatureAverage(?float $temperatureAverage): static
    {
        $this->temperatureAverage = $temperatureAverage;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(?int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getDemography(): ?int
    {
        return $this->demography;
    }

    public function setDemography(?int $demography): static
    {
        $this->demography = $demography;

        return $this;
    }

    public function getHousing(): ?string
    {
        return $this->housing;
    }

    public function setHousing(?string $housing): static
    {
        $this->housing = $housing;

        return $this;
    }

    public function getTimezone(): ?int
    {
        return $this->timezone;
    }

    public function setTimezone(int $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getEnvironment(): ?string
    {
        return $this->environment;
    }

    public function setEnvironment(?string $environment): static
    {
        $this->environment = $environment;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCity($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCity() === $this) {
                $image->setCity(null);
            }
        }

        return $this;
    }
}
