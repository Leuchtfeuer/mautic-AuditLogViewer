<?php

namespace MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Controller;

use Mautic\CoreBundle\Controller\AbstractFormController;
use MauticPlugin\LeuchtfeuerAuditLogViewerBundle\Form\LogFilterType;
use Symfony\Component\HttpFoundation\Request;

class LeuchtfeuerAuditLogViewerController extends AbstractFormController
{
    use LogTrait;

    /**
     * @param int $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $page = 1)
    {
        $filterForm = $this->createForm(LogFilterType::class);
        $filterForm->handleRequest($request);

        $filters = null;
        if ($filterForm->isSubmitted()) {
            $formData  = $filterForm->getData();
            $userName  = $formData['userName'];
            $startDate = $formData['timePeriodStart'];
            $endDate   = $formData['timePeriodEnd'];
            $bundle    = $formData['bundle'];
            $object    = $formData['object'];
            $action    = $formData['action'];

            $filters = [
                'user_name'     => $userName,
                'start_date'    => $startDate,
                'end_date'      => $endDate,
                'bundle'        => $bundle,
                'object'        => $object,
                'action'        => $action,
            ];
        }

        $events = $this->getLogAuditLogs($filters, $page);
        $tmpl   = $request->isXmlHttpRequest() ? $request->get('tmpl', 'index') : 'index';

        return $this->delegateView([
            'viewParameters' => [
                'usersActivity'     => $events,
                'filters'           => $filters,
                'filterForm'        => $filterForm->createView(),
                'tmpl'              => $tmpl,
                'currentRoute'      => $this->generateUrl('mautic_auditlogviewer_index', ['page' => $page]),
            ],
            'contentTemplate' => '@LeuchtfeuerAuditLogViewer/AuditLog/list.html.twig',
            'passthroughVars' => [
                'activeLink'    => '#mautic_auditlogviewer_index',
                'route'         => $this->generateUrl('mautic_auditlogviewer_index', ['page' => $page]),
                'auditLogCount' => $events['total'],
            ],
        ]);
    }
}
