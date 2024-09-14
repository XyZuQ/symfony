<?php
/**
 *  Namespace Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    /**
     * Displays the dashboard page.
     */
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(Request $request): Response
    {
        return $this->render('dashboard/dashboard.html.twig', []);
    }

    /**
     * Displays the main dashboard with upcoming events.
     */
    #[Route('/dashboard/main', name: 'app_dashboard_main')]
    public function dashboardMain(EventRepository $eventRepository): Response
    {
        $currentDate = new \DateTime();

        $events = $eventRepository->createQueryBuilder('e')
            ->where('e.dateFrom >= :currentDate')
            ->setParameter('currentDate', $currentDate->format('Y-m-d'))
            ->orderBy('e.dateFrom', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('dashboard/main.html.twig', [
            'events' => $events,
        ]);
    }
}
