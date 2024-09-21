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
 * Interface EventServiceInterface.
 */
interface EventServiceInterface
{
    /**
     * @param int|null $categoryId categoryId
     */
    public function getAllEvent(?int $categoryId): array;

    /**
     * @param Event $event event
     */
    public function createEvent(Event $event): void;

    /**
     * @param int $id id
     */
    public function getEventById(int $id): Event;

    /**
     * @param Event $event event
     */
    public function editEvent(Event $event): void;

    /**
     * @param Event $event event
     */
    public function deleteEvent(Event $event): void;
}
