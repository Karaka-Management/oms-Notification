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

use phpOMS\Module\ModuleAbstract;

/**
 * Task controller class.
 *
 * @package Modules\Notification
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Controller extends ModuleAbstract
{
    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__ . '/../';

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const NAME = 'Notification';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const ID = 1008800000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    public static array $providing = [
        'Navigation',
    ];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    public static array $dependencies = [];
}
