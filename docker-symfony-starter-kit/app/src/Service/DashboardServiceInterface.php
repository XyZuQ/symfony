<?php
/**
 *  Dashboard Service Interface
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */

namespace App\Service;

/**
 * Interface DashboardServiceInterface.
 */
interface DashboardServiceInterface
{
    /**
     * Function to get event list for dashboard.
     */
    public function getDashboardEventList(): array;
}
