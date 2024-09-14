<?php
/**
 *  Category Entity
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 127, nullable: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, Event> A collection of events associated with the category
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'category')]
    private Collection $event;

    /**
     * Constructor initializes the events collection.
     */
    public function __construct()
    {
        $this->event = new ArrayCollection();
    }

    /**
     * Gets the ID of the category.
     *
     * @return int|null The category ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the ID of the category.
     *
     * @param int|null $id The category ID
     */
    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the name of the category.
     *
     * @return string|null The category name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name of the category.
     *
     * @param string|null $name The category name
     */
    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the collection of events associated with the category.
     *
     * @return Collection<int, Event> The event collection
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    /**
     * Adds an event to the category.
     *
     * @param Event $event The event to add
     */
    public function addEvent(Event $event): static
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
            $event->setCategory($this);
        }

        return $this;
    }

    /**
     * Removes an event from the category.
     *
     * @param Event $event The event to remove
     */
    public function removeEvent(Event $event): static
    {
        if ($this->event->removeElement($event)) {
            if ($event->getCategory() === $this) {
                $event->setCategory(null);
            }
        }

        return $this;
    }
}
