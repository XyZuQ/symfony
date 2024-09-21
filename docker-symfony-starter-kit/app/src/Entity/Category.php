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

/**
 * Class Category.
 */
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
     * @var Collection|ArrayCollection
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
     * Get user Id function.
     *
     * @return int|null int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id id
     *
     * @return $this this
     */
    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get name function.
     *
     * @return string|null string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name name
     *
     * @return $this
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
     * @param Event $event event
     *
     * @return $this this
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
     * @param Event $event event
     *
     * @return $this this
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
