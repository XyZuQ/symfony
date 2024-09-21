<?php
/**
 *  Contact Fixtures
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\DataFixtures;

use App\Entity\Contact;

/**
 * Class ContactFixtures.
 */
class ContactFixtures extends AbstractBaseFixtures
{
    /**
     * Data loading function.
     */
    protected function loadData(): void
    {
        $this->createMany(20, 'contact', function (int $i) {
            $contact = new Contact();
            $contact->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
                ->setEmail($this->faker->email)
                ->setPhone($this->faker->phoneNumber)
                ->setStreet($this->faker->streetAddress)
                ->setPostCode($this->faker->postcode)
                ->setCity($this->faker->city);

            return $contact;
        });

        $this->manager->flush();
    }
}
