<?php

namespace MauticPlugin\LeuchtfeuerLogBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;
use MauticPlugin\LeuchtfeuerLogBundle\Form\LogFilterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LogController extends FormController
{
    use LogTrait;

    public function indexAction(Request $request, $page = 1)
    {

        $session = $request->getSession();

        $filterForm = $this->createForm(LogFilterType::class);
        $filterForm->handleRequest($request);

        $filters = null;
        if ($filterForm->isSubmitted()) {
            $formData = $filterForm->getData();
            $filterParameter = $formData['filter'];
            $startDate = $formData['timePeriodStart'];
            $endDate = $formData['timePeriodEnd'];
            // $actionBundle = $formData['action'];
            // $userName = $formData['userName'];
            // $bundleBundle = $formData['bundle'];
            // $objectBundle = $formData['object'];

            $filters = [
                'filter'        => $filterParameter,
                'start_date'    => $startDate,
                'end_date'      => $endDate,
                // 'user_name'     => $userName,
                // 'action_bundle' => $actionBundle,
                // 'bundle_bundle' => $bundleBundle,
                // 'object_bundle' => $objectBundle,
            ];

            $session->set('mautic.users.auditlog.filters', $filters);
        } else {
            $filters = $session->get('mautic.users.auditlog.filters', []);
        }

        $events = $this->getLogAuditLogs($filters, $page);
        $tmpl   = $request->isXmlHttpRequest() ? $request->get('tmpl', 'index') : 'index';

        return $this->delegateView([
            'viewParameters' => [
                'usersActivity'     => $events,
                'filters'           => $filters,
                'filterForm'        => $filterForm->createView(),
                'tmpl'              => $tmpl,

            ],
            'contentTemplate' => '@LeuchtfeuerLog/AuditLog/list.html.twig',
            'passthroughVars' => [
                'activeLink'    => '#mautic_log_index',
                'route'         => $this->generateUrl('mautic_log_index', ['page' => $page]),
                'auditLogCount' => $events['total'],
            ]
        ]);
    }

    public function clearSession(SessionInterface $session)
    {
        $session->clear();

        $this->addFlash('success', 'Session data has been cleared.');
        return $this->redirectToRoute('mautic_log_index');
    }
}
