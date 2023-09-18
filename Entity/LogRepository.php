<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

class LogRepository extends CommonRepository
{
    /**
     * @param int $page
     * @param array $filters
     * @param int $limit
     *
     * @return array
     */
    public function getAllAuditLogs( $filters, $page = 1,$limit = 15)
    {
        $query = $this->createQueryBuilder('al')
        ->select('al.userName, al.userId, al.bundle, al.object,
            al.objectId, al.action, al.details, al.dateAdded, al.ipAddress')
        ->where('al.userName != :user')
        ->setParameter('user', 'System');

        if (isset($filters['user_name'])  && !empty($filters['user_name'])) {
            $query->andWhere('al.userName = :userName')
                ->setParameter('userName', $filters['user_name']);
        }

        if (isset($filters['bundle_bundle'])  && !empty($filters['bundle_bundle'])) {
            $query->andWhere('al.bundle IN (:bundleBundle)')
                ->setParameter('bundleBundle', $filters['bundle_bundle']);
        }

        if (isset($filters['object_bundle'])  && !empty($filters['object_bundle'])) {
            $query->andWhere('al.object IN (:objectBundle)')
                ->setParameter('objectBundle', $filters['object_bundle']);
        }

        if (isset($filters['start_date'])  && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date'])  && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['action_bundle'])  && !empty($filters['action_bundle'])) {
            $query->andWhere('al.action IN (:action)')
                ->setParameter('action', $filters['action_bundle']);
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
     * @param array $filters
     *
     * @return int
     */
    public function getAuditLogsCount($filters)
    {
        $query = $this->createQueryBuilder('al')
        ->select('COUNT(al)')
        ->where('al.userName != :user')
        ->setParameter('user', 'System');

        if (isset($filters['user_name'])  && !empty($filters['user_name'])) {
            $query->andWhere('al.userName = :userName')
                ->setParameter('userName', $filters['user_name']);
        }

        if (isset($filters['bundle_bundle'])  && !empty($filters['bundle_bundle'])) {
            $query->andWhere('al.bundle IN (:bundleBundle)')
                ->setParameter('bundleBundle', $filters['bundle_bundle']);
        }

        if (isset($filters['object_bundle'])  && !empty($filters['object_bundle'])) {
            $query->andWhere('al.object IN (:objectBundle)')
                ->setParameter('objectBundle', $filters['object_bundle']);
        }

        if (isset($filters['start_date'])  && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date'])  && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['action_bundle']) && !empty($filters['action_bundle'])) {
            $query->andWhere('al.action IN (:action)')
                ->setParameter('action', $filters['action_bundle']);
        }

        return $query->getQuery()->getSingleScalarResult();
    }
}
