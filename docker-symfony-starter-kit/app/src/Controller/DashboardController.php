<?php
/**
 *  Namespace Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Controller;

use App\Repository\EventRepository;
use App\Service\DashboardServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class DashboardController.
 */
class DashboardController extends AbstractController
{
    /**
     * @param DashboardServiceInterface $dashboardService
     */
    private DashboardServiceInterface $dashboardService;

    /**
     * @param DashboardServiceInterface $dashboardService
     */
    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(Request $request): Response
    {
        return $this->render('dashboard/dashboard.html.twig', []);
    }

    /**
     * @return Response
     */
    #[Route('/dashboard/main', name: 'app_dashboard_main')]
    public function dashboardMain(): Response
    {
        return $this->render('dashboard/main.html.twig', [
            'events' => $this->dashboardService->getDashboardEventList(),
        ]);
    }
}
