<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;

class LeuchtfeuerAuditLogViewerIntegration extends AbstractIntegration
{
    public const PLUGIN_NAME = 'LeuchtfeuerAuditLogViewer';
    public const DISPLAY_NAME = 'Audit Log Viewer by Leuchtfeuer';
    public const AUTHENTICATION_TYPE = 'none';

    public function getName()
    {
        return self::PLUGIN_NAME;
    }

    public function getDisplayName()
    {
        return self::DISPLAY_NAME;
    }

    public function getAuthenticationType()
    {
        return self::AUTHENTICATION_TYPE;
    }
}
