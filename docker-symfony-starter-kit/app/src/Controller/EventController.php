<?php
/**
 *  Event Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\CategoryServiceInterface;
use App\Service\EventServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EventController.
 */
class EventController extends AbstractController
{
    /**
     * @param EventServiceInterface $eventService eventService
     */
    private EventServiceInterface $eventService;

    /**
     * @param CategoryServiceInterface $categoryService categoryService
     */
    private CategoryServiceInterface $categoryService;

    /**
     * @param EventServiceInterface    $eventService    eventService
     * @param CategoryServiceInterface $categoryService categoryService
     */
    public function __construct(EventServiceInterface $eventService, CategoryServiceInterface $categoryService)
    {
        $this->eventService = $eventService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request request
     *
     * @return $this
     */
    #[Route('/events', name: 'app_events')]
    public function eventList(Request $request): Response
    {
        $selectedCategoryId = $request->query->get('category');

        return $this->render('event/eventList.html.twig', [
            'events' => $this->eventService->getAllEvent($selectedCategoryId),
            'categories' => $this->categoryService->getAllCategory(),
            'selectedCategoryId' => $selectedCategoryId,
        ]);
    }

    /**
     * @param Request $request request
     *
     * @return $this
     */
    #[Route('/event/create', name: 'app_event_create')]
    public function eventCreate(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventService->createEvent($event);

            return $this->redirectToRoute('app_events');
        }

        return $this->render('event/eventForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request request
     * @param Event   $event   event
     *
     * @return $this
     */
    #[Route('/event/edit/{id}', name: 'app_event_edit')]
    public function eventEdit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventService->editEvent($event);

            return $this->redirectToRoute('app_events');
        }

        return $this->render('event/eventForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Event $event event
     *
     * @return $this
     */
    #[Route('/event/delete/{id}', name: 'app_event_delete')]
    public function eventDelete(Event $event): Response
    {
        $this->eventService->deleteEvent($event);

        return $this->redirectToRoute('app_events');
    }
}
