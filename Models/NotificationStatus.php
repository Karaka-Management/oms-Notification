<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Notification\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Notification\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Notification status enum.
 *
 * @package Modules\Notification\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class NotificationStatus extends Enum
{
    public const DEFAULT = 0;
}
