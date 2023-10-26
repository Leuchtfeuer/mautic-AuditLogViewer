<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LogFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', TextType::class, [
                'required'      => false,
                'attr'          => [
                    'class'      => 'form-control',
                    'placeholder'=> 'Search by name',
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
                'attr'          => [
                    'class' => 'form-control',
                    'name'  => 'filterForm[actionBundle]',
                ],
                'placeholder'   => 'Select an action',
            ])
            ->add('bundle', ChoiceType::class, [
                'choices'   => [
                    'user'      => 'user',
                    'lead'      => 'lead',
                    'campaign'  => 'campaign',
                    'page'      => 'page',
                ],
                'required'      => false,
                'multiple'      => true,
                'attr'          => [
                    'class' => 'form-control',
                ],
            ])
            ->add('object', ChoiceType::class, [
                'choices'   => [
                    'user'      => 'user',
                    'lead'      => 'lead',
                    'campaign'  => 'campaign',
                    'page'      => 'page',
                    'security'  => 'security',
                ],
                'required'      => false,
                'multiple'      => true,
                'attr'          => [
                    'class' => 'form-control',
                ],
            ])
            ->add('timePeriodStart', DateType::class, [
                'widget'    => 'single_text',
                'required'  => false,
            ])
            ->add('timePeriodEnd', DateType::class, [
                'widget'    => 'single_text',
                'required'  => false,
            ])
            ->add('submit', SubmitType::class, [
                'label'     => 'Apply',
            ]
            );
    }
}
