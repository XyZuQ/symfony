<?php
/**
 *  Dashboard Service
 *  This file is part of the project.
 *
 *  (c) Michał Plata <michal@plata.com>
 */
namespace App\Service;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DashboardService
 */
class DashboardService implements DashboardServiceInterface
{

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return array
     */
    public function getDashboardEventList(): array
    {
        $currentDate = new \DateTime();

        return $this->entityManager->getRepository(Event::class)->createQueryBuilder('e')
            ->where('e.dateTo >= :currentDate')
            ->setParameter('currentDate', $currentDate->format('Y-m-d'))
            ->orderBy('e.dateFrom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
