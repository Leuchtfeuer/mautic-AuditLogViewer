<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;

class LogIntegration extends AbstractIntegration
{
    public const PLUGIN_NAME = 'Log';

    public function getName()
    {
        return self::PLUGIN_NAME;
    }

    public function getDisplayName()
    {
        return 'This is auditlog table';
    }

    public function getAuthenticationType()
    {
        return 'none';
    }
}