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

use Modules\Notification\Controller\ApiController;
use Modules\Notification\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/notification/seen(\?.*|$)' => [
        [
            'dest'       => '\Modules\Notification\Controller\ApiController:apiNotificationSeenCreate',
            'verb'       => RouteVerb::SET,
            'csrf'       => true,
            'active' => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::NOTIFICATION,
            ],
        ],
    ],
    '^.*/notification(\?.*|$)' => [
        [
            'dest'       => '\Modules\Notification\Controller\ApiController:apiNotificationsGet',
            'verb'       => RouteVerb::GET,
            'csrf'       => true,
            'active' => true,
            'permission' => [
                'module' => ApiController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::NOTIFICATION,
            ],
        ],
    ],
];
