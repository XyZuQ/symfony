<?php
/**
 *  Homepage Controller
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    /**
     * Redirects to the main dashboard.
     */
    #[Route('/', name: 'app_homepage')]
    public function dashboard(Request $request): Response
    {
        return $this->redirectToRoute('app_dashboard_main');
    }
}
