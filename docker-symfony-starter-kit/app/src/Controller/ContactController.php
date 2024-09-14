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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    protected $entityManager;

    /**
     * ContactController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Displays a list of contacts.
     */
    #[Route('/contacts', name: 'app_contacts')]
    public function contactList(Request $request): Response
    {
        return $this->render('contact/contactList.html.twig', [
            'items' => $this->entityManager->getRepository(Contact::class)->findAll(),
        ]);
    }

    /**
     * Creates a new contact.
     */
    #[Route('/contact/create', name: 'app_contact_create')]
    public function contactCreate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contact/contactForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Edits an existing contact.
     */
    #[Route('/contact/edit/{id}', name: 'app_contact_edit')]
    public function contactEdit(int $id, Request $request): Response
    {
        $contact = $this->entityManager->getRepository(Contact::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found.');
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contact/contactEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a contact.
     */
    #[Route('/contact/delete/{id}', name: 'app_contact_delete')]
    public function contactDelete(int $id, Request $request): Response
    {
        $contact = $this->entityManager->getRepository(Contact::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found.');
        }

        $this->entityManager->remove($contact);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_contacts');
    }
}
