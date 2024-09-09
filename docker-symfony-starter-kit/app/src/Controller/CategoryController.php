<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use App\Form\CategoryType;
use App\Form\ContactType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{

    protected $categoryRepository;
    protected $entityManager;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/categories', name: 'app_categories')]
    public function categoryList(Request $request): Response
    {
        return $this->render('category/categoryList.html.twig', [
            'items' => $this->categoryRepository->findAll()
        ]);
    }

    #[Route('/category/create', name: 'app_category_create')]
    public function categoryCreate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($category->getEvent() as $event) {
                $event->setCategory($category);
            }

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/categoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/edit/{id}', name: 'app_category_edit')]
    public function categoryEdit(int $id, Request $request): Response
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found.');
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($category->getEvent() as $event) {
                $event->setCategory($category);
            }

            $this->entityManager->persist($category);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/categoryForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/delete/{id}', name: 'app_category_delete')]
    public function categoryDelete(int $id, Request $request): Response
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found.');
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_categories');
    }
}