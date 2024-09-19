<?php
/**
 *  Category Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Service\CategoryService;
use App\Service\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class CategoryController
 */
class CategoryController extends AbstractController
{
    /**
     * @param CategoryService $categoryService
     */
    private CategoryServiceInterface $categoryService;

    /**
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/categories', name: 'app_categories')]
    public function categoryList(Request $request): Response
    {
        return $this->render('category/categoryList.html.twig', [
            'items' => $this->categoryService->getAllCategory(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/category/create', name: 'app_category_create')]
    public function categoryCreate(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->createCategory($category);

            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/categoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/category/edit/{id}', name: 'app_category_edit')]
    public function categoryEdit(int $id, Request $request): Response
    {
        $category = $this->categoryService->getCategoryById($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->editCategory($category);

            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/categoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/category/delete/{id}', name: 'app_category_delete')]
    public function categoryDelete(int $id, Request $request): Response
    {
        $category = $this->categoryService->getCategoryById($id);

        $this->categoryService->deleteCategory($category);

        return $this->redirectToRoute('app_categories');
    }
}
