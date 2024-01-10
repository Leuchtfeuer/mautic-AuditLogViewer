<?php

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LogFilterType extends AbstractType
{
    /**
     * @param array<mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', TextType::class, [
                'required'      => false,
                'attr'          => [
                    'class'         => 'form-control search',
                    'id'            => 'list-search',
                    'name'          => 'userName',
                    'placeholder'   => 'Username',
                ],
            ])
            ->add('action', ChoiceType::class, [
                'choices'   => [
                    'delete'     => 'delete',
                    'create'     => 'create',
                    'identified' => 'identified',
                    'ipadded'    => 'ipadded',
                    'update'     => 'update',
                    'login'      => 'login',
                ],
                'required'      => false,
                'multiple'      => true,
            ])
            ->add('bundle', ChoiceType::class, [
                'choices'   => [
                    'user'           => 'user',
                    'lead'           => 'lead',
                    'campaign'       => 'campaign',
                    'page'           => 'page',
                    'dynamicContent' => 'dynamicContent',
                    'form'           => 'form',
                    'email'          => 'email',
                    'stage'          => 'stage',
                    'asset'          => 'asset',
                ],
                'required'      => false,
                'multiple'      => true,
                'attr'          => [
                    'class' => 'form-control',
                ],
            ])
            ->add('object', ChoiceType::class, [
                'choices'   => [
                    'user'           => 'user',
                    'lead'           => 'lead',
                    'campaign'       => 'campaign',
                    'page'           => 'page',
                    'security'       => 'security',
                    'client'         => 'client',
                    'company'        => 'company',
                    'config'         => 'config',
                    'email'          => 'email',
                    'form'           => 'form',
                    'segment'        => 'segment',
                    'dynamicContent' => 'dynamicContent',
                    'stage'          => 'stage',
                    'asset'          => 'asset'
                ],
                'required'      => false,
                'multiple'      => true,
                'attr'          => [
                    'class' => 'form-control',
                ],
            ])
            ->add('timePeriodStart', DateType::class,
                [
                    'widget'    => 'single_text',
                    'required'  => false,
                ])
            ->add('timePeriodEnd', DateType::class, [
                    'widget'    => 'single_text',
                    'required'  => false,
                ]);
    }
}
