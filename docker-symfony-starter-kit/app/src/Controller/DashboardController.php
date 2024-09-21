<?php
/**
 *  Namespace Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Controller;

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
     * @param DashboardServiceInterface $dashboardService dashboardService
     */
    private DashboardServiceInterface $dashboardService;

    /**
     * @param DashboardServiceInterface $dashboardService dashboardService
     */
    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * @param Request $request request
     *
     * @return $this
     */
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(Request $request): Response
    {
        return $this->render('dashboard/dashboard.html.twig', []);
    }

    /**
     * @return $this
     */
    #[Route('/dashboard/main', name: 'app_dashboard_main')]
    public function dashboardMain(): Response
    {
        return $this->render('dashboard/main.html.twig', [
            'events' => $this->dashboardService->getDashboardEventList(),
        ]);
    }
}
