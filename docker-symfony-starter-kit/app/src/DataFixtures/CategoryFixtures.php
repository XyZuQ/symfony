<?php
/**
 *  Category fixtures
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\DataFixtures;

use App\Entity\Category;

/**
 * Class CategoryFixtures
 */
class CategoryFixtures extends AbstractBaseFixtures
{
    /**
     * @return void
     */
    protected function loadData(): void
    {
        $this->createMany(10, 'category', function (int $i) {
            $category = new Category();
            $category->setName($this->faker->word);

            return $category;
        });

        $this->manager->flush();
    }
}
