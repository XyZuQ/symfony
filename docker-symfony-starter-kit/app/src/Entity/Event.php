<?php
/**
 *  Event Entity
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an event in the system.
 *
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    /**
     * @var int|null the unique identifier for the event
     *
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null the name of the event
     *
     * @ORM\Column(length=127)
     */
    #[ORM\Column(length: 127)]
    private ?string $name = null;

    /**
     * @var string|null the description of the event
     *
     * @ORM\Column(length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var \DateTimeInterface|null the start date of the event
     *
     * @ORM\Column(type=Types::DATE_MUTABLE)
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFrom = null;

    /**
     * @var \DateTimeInterface|null the end date of the event
     *
     * @ORM\Column(type=Types::DATE_MUTABLE)
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTo = null;

    /**
     * @var Category|null the category to which the event belongs
     *
     * @ORM\ManyToOne(inversedBy="event")
     */
    #[ORM\ManyToOne(inversedBy: 'event')]
    private ?Category $category = null;

    /**
     * Gets the unique identifier for the event.
     *
     * @return int|null The unique identifier
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the name of the event.
     *
     * @return string|null The name of the event
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name of the event.
     *
     * @param string $name The name of the event
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the description of the event.
     *
     * @return string|null The description of the event
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets the description of the event.
     *
     * @param string $description The description of the event
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the start date of the event.
     *
     * @return \DateTimeInterface|null The start date of the event
     */
    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    /**
     * Sets the start date of the event.
     *
     * @param \DateTimeInterface $dateFrom The start date of the event
     */
    public function setDateFrom(\DateTimeInterface $dateFrom): static
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Gets the end date of the event.
     *
     * @return \DateTimeInterface|null The end date of the event
     */
    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    /**
     * Sets the end date of the event.
     *
     * @param \DateTimeInterface $dateTo The end date of the event
     */
    public function setDateTo(\DateTimeInterface $dateTo): static
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Gets the category to which the event belongs.
     *
     * @return Category|null The category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Gets the name of the category to which the event belongs.
     * Returns '-' if the event has no category or if the category name is null.
     *
     * @return string The name of the category or '-'
     */
    public function getCategoryName(): ?string
    {
        if (null === $this->category) {
            return '-';
        }

        return $this->category->getName() ? (string) $this->category->getName() : '-';
    }

    /**
     * Sets the category to which the event belongs.
     *
     * @param Category|null $category The category to set
     */
    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
