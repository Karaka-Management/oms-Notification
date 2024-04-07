<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Notification\Controller\BackendController;
use Modules\Notification\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/notification/dashboard(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Notification\Controller\BackendController:viewNotificationDashboard',
            'verb'       => RouteVerb::GET,
            'active' => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::NOTIFICATION,
            ],
        ],
    ],
];
