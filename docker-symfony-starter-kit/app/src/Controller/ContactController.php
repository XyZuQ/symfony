<?php
/**
 *  Contact Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class ContactController
 */
class ContactController extends AbstractController
{
    /**
     * @param ContactServiceInterface $contactService
     */
    private ContactServiceInterface $contactService;

    /**
     * @param ContactServiceInterface $categoryService
     */
    public function __construct(ContactServiceInterface $categoryService)
    {
        $this->contactService = $categoryService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/contacts', name: 'app_contacts')]
    public function contactList(Request $request): Response
    {
        return $this->render('contact/contactList.html.twig', [
            'items' => $this->contactService->getAllContact(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/contact/create', name: 'app_contact_create')]
    public function contactCreate(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->contactService->createContact($contact);

            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contact/contactForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/contact/edit/{id}', name: 'app_contact_edit')]
    public function contactEdit(int $id, Request $request): Response
    {
        $contact = $this->contactService->getContactById($id);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->contactService->editContact($contact);

            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contact/contactEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/contact/delete/{id}', name: 'app_contact_delete')]
    public function contactDelete(int $id, Request $request): Response
    {
        $contact = $this->contactService->getContactById($id);

        $this->contactService->deleteContact($contact);

        return $this->redirectToRoute('app_contacts');
    }
}
