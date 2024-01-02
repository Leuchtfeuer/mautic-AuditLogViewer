<?php

return [
    'name'          => 'Audit Log Viewer by Leuchtfeuer',
    'description'   => 'Introduce menu item which gives access to the Audit Log',
    'version'       => '2.0',
    'author'        => 'Leuchtfeuer Digital Marketing GmbH',

    'routes'        => [
        'main' => [
            'mautic_auditlogviewer_index'  => [
                'path'       => '/log/{page}',
                'controller' => 'MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Controller\LeuchtfeuerAuditLogViewerController::indexAction',
            ],
        ],
    ],

    'menu'  => [
        'main'  => [
            'mautic.auditlogviewer.menu.index' => [
                    'access'        => 'admin',
                    'iconClass'     => 'fa-archive',
                    'route'         => 'mautic_auditlogviewer_index',
                    'checks'        => [
                        'integration'   => [
                            'LeuchtfeuerAuditLogViewer'   => [
                                'enabled'   => true,
                            ],
                        ],
                    ],
                    'priority'      => -10,
            ],
        ],
    ],

    'services'      => [
        'integrations'  => [
            'mautic.integration.leuchtfeuerauditlogviewer' => [
                'class'     => \MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Integration\LeuchtfeuerAuditLogViewerIntegration::class,
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
