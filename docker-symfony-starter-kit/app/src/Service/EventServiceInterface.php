<?php
/**
 *  Event Service Interface
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Service;

use App\Entity\Event;

/**
 * Interface EventServiceInterface
 */
interface EventServiceInterface
{
    /**
     * @param int|null $categoryId
     *
     * @return array
     */
    public function getAllEvent(?int $categoryId): array;

    /**
     * @param Event $event
     *
     * @return void
     */
    public function createEvent(Event $event): void;

    /**
     * @param int $id
     *
     * @return Event
     */
    public function getEventById(int $id): Event;

    /**
     * @param Event $event
     *
     * @return void
     */
    public function editEvent(Event $event): void;

    /**
     * @param Event $event
     *
     * @return void
     */
    public function deleteEvent(Event $event): void;
}
