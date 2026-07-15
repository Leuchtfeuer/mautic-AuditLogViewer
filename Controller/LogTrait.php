<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Controller;

trait LogTrait
{
    /**
     * @param array<mixed> $filters
     * @param int          $page
     * @param int          $limit
     *
     * @return array<mixed>
     */
    protected function getLogAuditLogs($filters, $page = 1, $limit = 25)
    {
        $page  = (int) $page;
        $limit = (int) $limit;

        // Leuchtfeuer plugin administration log page
        /** @var \MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Model\LogModel $logModel */
        $logModel = $this->getModel('log.auditlog');

        $logCount = $logModel->getAuditLogsCount($filters);
        $logs     = $logModel->getAllAuditLogs($filters, $page, $limit);

        return [
            'events'    => $logs,
            'page'      => $page,
            'limit'     => $limit,
            'total'     => $logCount,
            'maxPages'  => ceil($logCount / $limit),
        ];
    }
}
