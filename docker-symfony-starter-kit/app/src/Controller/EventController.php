<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/events', name: 'app_events')]
    public function eventList(Request $request, EventRepository $eventRepository, CategoryRepository $categoryRepository): Response
    {
        $selectedCategoryId = $request->query->get('category');

        if ($selectedCategoryId) {
            $events = $eventRepository->findBy(['category' => $selectedCategoryId]);
        } else {
            $events = $eventRepository->findAll();
        }

        return $this->render('event/eventList.html.twig', [
            'events' => $events,
            'categories' => $categoryRepository->findAll(),
            'selectedCategoryId' => $selectedCategoryId,
        ]);
    }

    #[Route('/event/create', name: 'app_event_create')]
    public function eventCreate(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($event);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_events');
        }

        return $this->render('event/eventForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/event/edit/{id}', name: 'app_event_edit')]
    public function eventEdit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_events');
        }

        return $this->render('event/eventForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/event/delete/{id}', name: 'app_event_delete')]
    public function eventDelete(Event $event): Response
    {
        $this->entityManager->remove($event);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_events');
    }
}
