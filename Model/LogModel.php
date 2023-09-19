<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Model;

use Mautic\CoreBundle\Model\AbstractCommonModel;
use Doctrine\ORM\EntityManagerInterface;
use Mautic\CoreBundle\Security\Permissions\CorePermissions;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Mautic\CoreBundle\Translation\Translator;
use Mautic\CoreBundle\Helper\UserHelper;
use Psr\Log\LoggerInterface;
use Mautic\CoreBundle\Helper\CoreParametersHelper;
use Symfony\Contracts\Translation\TranslatorInterface;


class LogModel extends AbstractCommonModel
{
    /**
     * {@inheritdoc}
     *
     * @return \MauticPlugin\LeuchtfeuerLogBundle\Entity\LogRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('MauticPlugin\LeuchtfeuerLogBundle\Entity\Log');
    }
}
