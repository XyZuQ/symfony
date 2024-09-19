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
 * Interface CategoryServiceInterface
 */
interface CategoryServiceInterface
{
    /**
     * @return array
     */
    public function getAllCategory(): array;

    /**
     * @param Category $category
     *
     * @return void
     */
    public function createCategory(Category $category): void;

    /**
     * @param int $id
     *
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @param Category $category
     *
     * @return void
     */
    public function editCategory(Category $category): void;

    /**
     * @param Category $category
     *
     * @return void
     */
    public function deleteCategory(Category $category): void;
}
