<?php
/**
 *  Category Service
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryService.
 */
class ContactService implements ContactServiceInterface
{
    /**
     * @param EntityManagerInterface $entityManager entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * Function to get all contacts.
     *
     * @return $this
     */
    public function getAllContact(): array
    {
        return $this->entityManager->getRepository(Contact::class)->findAll();
    }

    /**
     * @param int $id id
     *
     * @return $this
     */
    public function getContactById(int $id): Contact
    {
        return $this->entityManager->getRepository(Contact::class)->find($id);
    }

    /**
     * @param Contact $contact contact
     */
    public function createContact(Contact $contact): void
    {
        $this->entityManager->persist($contact);
        $this->entityManager->flush();
    }

    /**
     * @param Contact $contact contact
     */
    public function editContact(Contact $contact): void
    {
        $this->entityManager->persist($contact);
        $this->entityManager->flush();
    }

    /**
     * @param Contact $contact contact
     */
    public function deleteContact(Contact $contact): void
    {
        $this->entityManager->remove($contact);
        $this->entityManager->flush();
    }
}
