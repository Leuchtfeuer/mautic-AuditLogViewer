<?php

return [
    'name'          => 'LeuchtfeuerLog',
    'description'   => 'Displays live audit log table',
    'version'       => '1.0',
    'author'        => 'Alan Syrgak',

    'routes'        => [
        'main' => [
            'mautic_log_index'  => [
                'path'  => '/log/{page}',
                'controller' => 'MauticPlugin\LeuchtfeuerLogBundle\Controller\LogController::indexAction',
            ],
            'mautic_log_clear'  => [
                'path'  => '/log/clear',
                'controller'    => 'MauticPlugin\LeuchtfeuerLogBundle\Controller\LogController::clearSession',
            ]
        ]
    ],

    'menu'  => [
        'main'  => [
            'mautic.log.menu.index' => [
                    'access'        => 'admin',
                    'iconClass'     => 'fa-archive',
                    'route'         => 'mautic_log_index',
                    'checks'        => [
                        'integration'   => [
                            'Log'   =>  [
                                'enabled'   => true,
                            ]
                        ]
                    ],
                    'priority'      => -10,
            ]
        ]
    ],

    'services'      => [
        'integrations'  => [
            'mautic.integration.log' => [
                'class'     => \MauticPlugin\LeuchtfeuerLogBundle\Integration\LogIntegration::class,
                'arguments' => [
                    'event_dispatcher',
                    'mautic.helper.cache_storage',
                    'doctrine.orm.entity_manager',
                    'session',
                    'request_stack',
                    'router',
                    'translator',
                    'logger',
                    'mautic.helper.encryption',
                    'mautic.lead.model.lead',
                    'mautic.lead.model.company',
                    'mautic.helper.paths',
                    'mautic.core.model.notification',
                    'mautic.lead.model.field',
                    'mautic.plugin.model.integration_entity',
                    'mautic.lead.model.dnc',
                ],
            ],
        ],
    ],
];