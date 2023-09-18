<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\AuditLog;

class Log extends AuditLog
{
    public static function loadMetadata(ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('audit_log')
            ->setCustomRepositoryClass(LogRepository::class);
    }
}