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


class LogModel extends AbstractCommonModel
{
    /**
     * @param EntityManagerInterface $em
     * @param CorePermissions $security
     * @param EventDispatcherInterface $dispatcher
     * @param UrlGeneratorInterface $router
     * @param Translator $translator
     * @param UserHelper $userHelper
     * @param LoggerInterface $mauticLogger
     * @param CoreParametersHelper $coreParametersHelper
     */
    public function __construct(
        EntityManagerInterface $em,
        CorePermissions $security,
        EventDispatcherInterface $dispatcher,
        UrlGeneratorInterface $router,
        TranslatorInterface $translator,
        UserHelper $userHelper,
        LoggerInterface $mauticLogger,
        CoreParametersHelper $coreParametersHelper
    ) {
        parent::__construct($em, $security, $dispatcher, $router, $translator, $userHelper, $mauticLogger, $coreParametersHelper);
        // Initialize any additional dependencies or perform other setup if needed
    }

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
