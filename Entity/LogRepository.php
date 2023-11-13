<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;
use Mautic\CoreBundle\Translation\Translator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class LogRepository extends CommonRepository
{
    /**
     * @param string $filter_old
     * @param string $filter_new
     *
     * @return array
     */
    private function getFilter(string $filter)
    {
        $parts_of_filter = explode(":", $filter);
        $parts_of_filter[0] .= ":";

        if ($parts_of_filter[0] == "username:") {
            array_push($parts_of_filter, 1);
        } else if ($parts_of_filter[0] == "bundle:") {
            array_push($parts_of_filter, 2);
        } else if ($parts_of_filter[0] == "object:") {
            array_push($parts_of_filter, 3);
        } else if ($parts_of_filter[0] == "objectid:") {
            array_push($parts_of_filter, 4);
        } else if ($parts_of_filter[0] == "action:") {
            array_push($parts_of_filter, 5);
        } else {
            return "The specified parameter was not found";
        }

        return $parts_of_filter;
    }

    /**
     * @param int $page
     * @param array $filters
     * @param int $limit
     *
     * @return array
     */
    public function getAllAuditLogs($filters, $page = 1,$limit = 25)
    {
        $query = $this->createQueryBuilder('al')
        ->select('al.userName, al.userId, al.bundle, al.object,
            al.objectId, al.action, al.details, al.dateAdded, al.ipAddress')
        ->where('al.userName != :user')
        ->setParameter('user', 'System');

        if (isset($filters['start_date'])  && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date'])  && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['filter']) && !empty($filters['filter'])) {
            $separeted_filter = $this->getFilter($filters['filter']);
            if ($separeted_filter[2] == 1) {
                $query->andWhere('al.userName = :userName')
                      ->setParameter('userName', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 2) {
                $query->andWhere('al.bundle = :bundle')
                      ->setParameter('bundle', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 3) {
                $query->andWhere('al.object = :object')
                      ->setParameter('object', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 4) {
                $query->andWhere('al.objectId = :objectId')
                      ->setParameter('objectId', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 5) {
                $query->andWhere('al.action = :action')
                      ->setParameter('action', $separeted_filter[1]);
            }
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

        if (isset($filters['start_date'])  && !empty($filters['start_date'])) {
            $query->andWhere('al.dateAdded >= :startDate')
                ->setParameter('startDate', $filters['start_date']);
        }

        if (isset($filters['end_date'])  && !empty($filters['end_date'])) {
            $query->andWhere('al.dateAdded <= :endDate')
                ->setParameter('endDate', $filters['end_date']);
        }

        if (isset($filters['filter']) && !empty($filters['filter'])) {
            $separeted_filter = $this->getFilter($filters['filter']);
            if ($separeted_filter[2] == 1) {
                $query->andWhere('al.userName = :userName')
                      ->setParameter('userName', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 2) {
                $query->andWhere('al.bundle = :bundle')
                      ->setParameter('bundle', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 3) {
                $query->andWhere('al.object = :object')
                      ->setParameter('object', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 4) {
                $query->andWhere('al.objectId = :objectId')
                      ->setParameter('objectId', $separeted_filter[1]);
            } else if ($separeted_filter[2] == 5) {
                $query->andWhere('al.action = :action')
                      ->setParameter('action', $separeted_filter[1]);
            }
        }

        return $query->getQuery()->getSingleScalarResult();
    }
}
