<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\AuditLog;

class Log extends AuditLog
{
    public static function loadMetadata(ClassMetadata $metadata): void
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('audit_log')
            ->setCustomRepositoryClass(LogRepository::class);
    }
}
