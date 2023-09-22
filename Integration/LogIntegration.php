<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;
use Symfony\Contracts\Translation\TranslatorInterface;

class LogIntegration extends AbstractIntegration
{
    private $translator;

    public const PLUGIN_NAME = 'Log';

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getName()
    {
        return self::PLUGIN_NAME;
    }

    public function getDisplayName()
    {
        return $this->translator->trans('mautic.log.log.name');
    }

    public function getAuthenticationType()
    {
        return 'none';
    }
}
