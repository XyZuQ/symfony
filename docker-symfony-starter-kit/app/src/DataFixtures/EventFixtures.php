<?php
/**
 *  Event Fixtures
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\DataFixtures;

use App\Entity\Event;

/**
 * Class EventFixtures.
 */
class EventFixtures extends AbstractBaseFixtures
{
    /**
     * Data loading function.
     */
    protected function loadData(): void
    {
        $this->createMany(30, 'event', function (int $i) {
            $event = new Event();
            $event->setName($this->faker->sentence(3))
                ->setDescription($this->faker->paragraph)
                ->setDateFrom($this->faker->dateTimeBetween('-1 years', 'now'))
                ->setDateTo($this->faker->dateTimeBetween('now', '+1 years'));

            if ($this->faker->boolean(80)) {
                $event->setCategory($this->getRandomReference('category'));
            }

            return $event;
        });

        $this->manager->flush();
    }
}
