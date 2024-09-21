<?php
/**
 *  Category Service Interface
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

use App\Entity\Category;

/**
 * Interface CategoryServiceInterface.
 */
interface CategoryServiceInterface
{
    /**
     * Function to get all categories.
     */
    public function getAllCategory(): array;

    /**
     * @param Category $category category
     */
    public function createCategory(Category $category): void;

    /**
     * @param int $id id
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param Category $category category
     */
    public function editCategory(Category $category): void;

    /**
     * @param Category $category category
     */
    public function deleteCategory(Category $category): void;
}
