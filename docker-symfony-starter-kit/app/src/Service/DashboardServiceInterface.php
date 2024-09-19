<?php
/**
 *  Dashboard Service Interface
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Service;

/**
 * Interface DashboardServiceInterface
 */
interface DashboardServiceInterface
{
    /**
     * @return array
     */
    public function getDashboardEventList(): array;
}
