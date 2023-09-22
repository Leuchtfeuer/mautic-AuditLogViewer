<?php

declare(strict_types=1);

namespace MauticPlugin\LeuchtfeuerLogBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\BasicInterface;
class LogIntegration extends BasicIntegration implements BasicInterface
{
    use ConfigurationTrait;

    public const PLUGIN_NAME = 'Log';
    public const DISPLAY_NAME = 'Audit Log Viewer';

    public function getName(): string
    {
        return self::PLUGIN_NAME;
    }

    public function getDisplayName(): string
    {
        return self::DISPLAY_NAME;
    }

    public function getIcon(): string
    {
        return 'plugins/LeuchtfeuerLogBundle/Assets/img/log.png';
    }
}
