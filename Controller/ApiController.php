<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Notification
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Notification\Controller;

use Modules\Notification\Models\NotificationMapper;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\System\MimeType;

/**
 * Api controller for the tasks module.
 *
 * @package Modules\Notification
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method to create a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiNotificationSeenCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        $now = new \DateTimeImmutable('now');

        /** @var \Modules\Notification\Models\Notification[] $notifications */
        $notifications = NotificationMapper::getAll()
            ->where('createdFor', $request->header->account)
            ->where('seenAt', null)
            ->where('createdAt', $now, '<') // Don't show pre-created notifications
            ->sort('createdAt', OrderType::ASC)
            ->execute();

        foreach ($notifications as $notification) {
            $new         = clone $notification;
            $new->seenAt = $now;

            $this->updateModel($request->header->account, $notification, $new, NotificationMapper::class, 'notification', $request->getOrigin());
        }

        $this->createStandardUpdateResponse($request, $response, []);
    }

    /**
     * Api method to create a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiNotificationsGet(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        $now           = new \DateTimeImmutable('now');
        $notifications = NotificationMapper::getAll()
            ->where('createdFor', $request->header->account)
            ->where('seenAt', null)
            ->where('createdAt', $now, '<') // Don't show pre-created notifications
            ->where('createdAt', $request->getDataDateTime('start') ?? $now->modify('-1 hour'), '>')
            ->sort('createdAt', OrderType::ASC)
            ->execute();

        $response->header->set('Content-Type', MimeType::M_JSON . '; charset=utf-8', true);
        $response->data[$request->uri->__toString()] = [
            'status'   => NotificationLevel::OK,
            'title'    => 'New Notification',
            'message'  => 'You have new notifications',
            'response' => $notifications,
        ];
    }
}
