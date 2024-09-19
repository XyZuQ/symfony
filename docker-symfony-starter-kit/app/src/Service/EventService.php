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
 * Class EventService
 */
class EventService implements EventServiceInterface
{

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param int|null $categoryId
     *
     * @return array
     */
    public function getAllEvent(?int $categoryId): array
    {
        if ($categoryId) {
            return $this->entityManager->getRepository(Event::class)->findBy(['category' => $categoryId]);
        }

        return $this->entityManager->getRepository(Event::class)->findAll();
    }

    /**
     * @param int $id
     *
     * @return Event
     */
    public function getEventById(int $id): Event
    {
        return $this->entityManager->getRepository(Event::class)->find($id);
    }

    /**
     * @param Event $event
     *
     * @return void
     */
    public function createEvent(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    /**
     * @param Event $event
     *
     * @return void
     */
    public function editEvent(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    /**
     * @param Event $event
     *
     * @return void
     */
    public function deleteEvent(Event $event): void
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();
    }
}
