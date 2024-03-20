<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Notification
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Notification\Controller;

use Modules\Dashboard\Models\DashboardElementInterface;
use Modules\Notification\Models\NotificationMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Backend controller for the tasks module.
 *
 * @property \Web\WebApplication $app
 *
 * @package Modules\Notification
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class BackendController extends Controller implements DashboardElementInterface
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface Returns a renderable object
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewNotificationDashboard(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Notification/Theme/Backend/notification-dashboard');

        $view->data['notifications'] = NotificationMapper::getAll()
            ->where('createdFor', $request->header->account)
            ->where('seenAt', null)
            ->where('createdAt', new \DateTime('now'), '<') // Don't show future notifications
            ->sort('createdAt', OrderType::ASC)
            ->execute();

        return $view;
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Notification/Theme/Backend/dashboard-notification');

        $view->data['notifications'] = NotificationMapper::getAll()
            ->where('createdFor', $request->header->account)
            ->where('seenAt', null)
            ->where('createdAt', new \DateTime('now'), '<') // Don't show future notifications
            ->sort('createdAt', OrderType::ASC)
            ->limit(5)
            ->execute();

        return $view;
    }

    /**
     * Count unread messages
     *
     * @param int $account Account id
     *
     * @return int Returns the amount of unread tasks
     *
     * @since 1.0.0
     */
    public function openNav(int $account) : int
    {
        return NotificationMapper::count()
            ->where('createdFor', $account)
            ->where('seenAt', null)
            ->where('createdAt', new \DateTime('now'), '<') // Don't show future notifications
            ->executeCount();
    }
}
