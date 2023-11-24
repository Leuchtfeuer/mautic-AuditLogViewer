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
            $userName = $formData['userName'];
            $startDate = $formData['timePeriodStart'];
            $endDate = $formData['timePeriodEnd'];
            $bundle = $formData['bundle'];
            $object = $formData['object'];
            $action = $formData['action'];

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
                'currentRoute'      => $this->generateUrl('mautic_log_index', ['page' => $page]),
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
