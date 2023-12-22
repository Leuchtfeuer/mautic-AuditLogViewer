<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Controller;

trait LogTrait
{
    protected function getLogAuditLogs($filters, $page = 1, $limit = 25)
    {
        // Leuchtfeuer plugin administration log page
        /** @var \MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Model\LogModel $logModel */
        $logModel = $this->getModel('log.auditlog');
        /** @var \MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Entity\LogRepository $logRepository */
        $logRepository = $logModel->getRepository();

        $logCount = $logRepository->getAuditLogsCount($filters);
        $logs = $logRepository->getAllAuditLogs($filters, $page, $limit);

        return [
            'events'    => $logs,
            'page'      => $page,
            'limit'     => $limit,
            'total'     => $logCount,
            'maxPages'  => ceil($logCount / $limit),
        ];
    }
}
