<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerLogBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;

class LogIntegration extends AbstractIntegration
{
    public const PLUGIN_NAME = 'Log';
    public const DISPLAY_NAME = 'Audit Log Viewer';

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
        return 'none';
    }
}
