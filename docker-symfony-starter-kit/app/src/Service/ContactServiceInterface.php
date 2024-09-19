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
 * Interface ContactServiceInterface
 */
interface ContactServiceInterface
{
    /**
     * @return array
     */
    public function getAllContact(): array;

    /**
     * @param Contact $contact
     *
     * @return void
     */
    public function createContact(Contact $contact): void;

    /**
     * @param int $id
     *
     * @return Contact
     */
    public function getContactById(int $id): Contact;

    /**
     * @param Contact $contact
     *
     * @return void
     */
    public function editContact(Contact $contact): void;

    /**
     * @param Contact $contact
     *
     * @return void
     */
    public function deleteContact(Contact $contact): void;
}
