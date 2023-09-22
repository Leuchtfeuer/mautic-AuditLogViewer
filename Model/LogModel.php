<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Model;

use Mautic\CoreBundle\Model\AbstractCommonModel;

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
