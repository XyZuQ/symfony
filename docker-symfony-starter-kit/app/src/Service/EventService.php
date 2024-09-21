<?php
/**
 *  Event Service
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class EventService.
 */
class EventService implements EventServiceInterface
{
    /**
     * @param EntityManagerInterface $entityManager entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * Function for getting all events.
     *
     * @param int|null $categoryId categoryId
     *
     * @return $this
     */
    public function getAllEvent(?int $categoryId): array
    {
        if ($categoryId) {
            return $this->entityManager->getRepository(Event::class)->findBy(['category' => $categoryId]);
        }

        return $this->entityManager->getRepository(Event::class)->findAll();
    }

    /**
     * Funstion for getting events by Id.
     *
     * @param int $id id
     *
     * @return $this
     */
    public function getEventById(int $id): Event
    {
        return $this->entityManager->getRepository(Event::class)->find($id);
    }

    /**
     * Function for event creation.
     *
     * @param Event $event event
     */
    public function createEvent(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    /**
     * @param Event $event event
     */
    public function editEvent(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    /**
     * @param Event $event event
     */
    public function deleteEvent(Event $event): void
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();
    }
}
