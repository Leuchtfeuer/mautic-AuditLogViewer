<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

class LogRepository extends CommonRepository
{
    /**
     * @param array<mixed> $filters
     * @param int          $page
     * @param int          $limit
     *
     * @return array<mixed>
     */
    public function getAllAuditLogs($filters, $page = 1, $limit = 25)
    {
        $query = $this->createQueryBuilder('al')
        ->select('al.userName, al.userId, al.bundle, al.object,
            al.objectId, al.action, al.details, al.dateAdded, al.ipAddress')
        ->where('al.userName != :user')
        ->setParameter('user', 'System');

        if (isset($filters['user_name']) && !empty($filters['user_name'])) {
            $query->andWhere('al.userName LIKE :userName')
                ->setParameter('userName', '%'.$filters['user_name'].'%');
        }

        if (isset($filters['start_date']) && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date']) && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['bundle']) && !empty($filters['bundle'])) {
            $query->andWhere('al.bundle IN (:bundle)')
                ->setParameter('bundle', $filters['bundle']);
        }

        if (isset($filters['object']) && !empty($filters['object'])) {
            $query->andWhere('al.object IN (:object)')
                ->setParameter('object', $filters['object']);
        }

        if (isset($filters['action']) && !empty($filters['action'])) {
            $query->andWhere('al.action IN (:action)')
                ->setParameter('action', $filters['action']);
        }

        if (0 === $page) {
            $page = 1;
        }
        $query->orderBy('al.dateAdded', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param array<mixed> $filters
     *
     * @return int
     */
    public function getAuditLogsCount($filters)
    {
        $query = $this->createQueryBuilder('al')
        ->select('COUNT(al)')
        ->where('al.userName != :user')
        ->setParameter('user', 'System');

        if (isset($filters['user_name']) && !empty($filters['user_name'])) {
            $query->andWhere('al.userName LIKE :userName')
                ->setParameter('userName', '%'.$filters['user_name'].'%');
        }

        if (isset($filters['start_date']) && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date']) && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['bundle']) && !empty($filters['bundle'])) {
            $query->andWhere('al.bundle IN (:bundle)')
                ->setParameter('bundle', $filters['bundle']);
        }

        if (isset($filters['object']) && !empty($filters['object'])) {
            $query->andWhere('al.object IN (:object)')
                ->setParameter('object', $filters['object']);
        }

        if (isset($filters['action']) && !empty($filters['action'])) {
            $query->andWhere('al.action IN (:action)')
                ->setParameter('action', $filters['action']);
        }

        return $query->getQuery()->getSingleScalarResult();
    }
}
