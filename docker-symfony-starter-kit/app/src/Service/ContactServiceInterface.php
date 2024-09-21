<?php
/**
 *  Contact Service Interface
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

use App\Entity\Contact;

/**
 * Interface ContactServiceInterface.
 */
interface ContactServiceInterface
{
    /**
     * Function to get all contacts.
     */
    public function getAllContact(): array;

    /**
     * @param Contact $contact contact
     */
    public function createContact(Contact $contact): void;

    /**
     * @param int $id id
     */
    public function getContactById(int $id): Contact;

    /**
     * @param Contact $contact contact
     */
    public function editContact(Contact $contact): void;

    /**
     * @param Contact $contact contact
     */
    public function deleteContact(Contact $contact): void;
}
