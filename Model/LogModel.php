<?php

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Model;

use Mautic\CoreBundle\Model\AbstractCommonModel;

class LogModel extends AbstractCommonModel
{
    /**
     * {@inheritdoc}
     *
     * @return \MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Entity\LogRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Entity\Log');
    }
}
