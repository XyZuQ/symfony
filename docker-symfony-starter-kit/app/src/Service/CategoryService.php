<?php
/**
 *  Category Service
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryService.
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * @param EntityManagerInterface $entityManager entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * Function to get all categories.
     *
     * @return $this
     */
    public function getAllCategory(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    /**
     * @param int $id id
     *
     * @return $this
     */
    public function getCategoryById(int $id): Category
    {
        return $this->entityManager->getRepository(Category::class)->find($id);
    }

    /**
     * @param Category $category category
     */
    public function createCategory(Category $category): void
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    /**
     * @param Category $category category
     */
    public function editCategory(Category $category): void
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    /**
     * @param Category $category category
     */
    public function deleteCategory(Category $category): void
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}
