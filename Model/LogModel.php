<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Model;

use Doctrine\ORM\QueryBuilder;
use Mautic\CoreBundle\Entity\AuditLog;
use Mautic\CoreBundle\Entity\AuditLogRepository;
use Mautic\CoreBundle\Model\AbstractCommonModel;

class LogModel extends AbstractCommonModel
{
    /**
     * @return AuditLogRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository(AuditLog::class);
    }

    /**
     * @param array<string, mixed>|null $filters
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllAuditLogs(?array $filters, int $page = 1, int $limit = 25): array
    {
        if (0 === $page) {
            $page = 1;
        }

        $query = $this->createAuditLogQueryBuilder($filters)
            ->orderBy('al.dateAdded', 'DESC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param array<string, mixed>|null $filters
     */
    public function getAuditLogsCount(?array $filters): int
    {
        $query = $this->createAuditLogQueryBuilder($filters, true);

        return (int) $query->getQuery()->getSingleScalarResult();
    }

    /**
     * @param array<string, mixed>|null $filters
     */
    private function createAuditLogQueryBuilder(?array $filters, bool $count = false): QueryBuilder
    {
        $query = $this->em->createQueryBuilder()
            ->from(AuditLog::class, 'al');

        if ($count) {
            $query->select('COUNT(al)');
        } else {
            $query->select('al.userName, al.userId, al.bundle, al.object, al.objectId, al.action, al.details, al.dateAdded, al.ipAddress');
        }

        $query->where('al.userName != :user')
            ->setParameter('user', 'System');

        if (null === $filters) {
            return $query;
        }

        if (!empty($filters['user_name'])) {
            $query->andWhere('al.userName LIKE :userName')
                ->setParameter('userName', '%'.$filters['user_name'].'%');
        }

        if (!empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (!empty($filters['bundle'])) {
            $query->andWhere('al.bundle IN (:bundle)')
                ->setParameter('bundle', $filters['bundle']);
        }

        if (!empty($filters['object'])) {
            $query->andWhere('al.object IN (:object)')
                ->setParameter('object', $filters['object']);
        }

        if (!empty($filters['action'])) {
            $query->andWhere('al.action IN (:action)')
                ->setParameter('action', $filters['action']);
        }

        return $query;
    }
}
