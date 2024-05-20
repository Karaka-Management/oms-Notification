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

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Notification mapper class.
 *
 * @package Modules\Notification\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Notification
 * @extends DataMapperFactory<T>
 */
final class NotificationMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'notification_id'         => ['name' => 'notification_id',         'type' => 'int',      'internal' => 'id'],
        'notification_title'      => ['name' => 'notification_title',      'type' => 'string',   'internal' => 'title'],
        'notification_desc'       => ['name' => 'notification_desc',       'type' => 'string',   'internal' => 'description'],
        'notification_desc_raw'   => ['name' => 'notification_desc_raw',   'type' => 'string',   'internal' => 'descriptionRaw'],
        'notification_type'       => ['name' => 'notification_type',       'type' => 'int',      'internal' => 'type'],
        'notification_status'     => ['name' => 'notification_status',     'type' => 'int',      'internal' => 'status'],
        'notification_module'     => ['name' => 'notification_module',       'type' => 'string',   'internal' => 'module'],
        'notification_category'   => ['name' => 'notification_category',     'type' => 'int',      'internal' => 'category'],
        'notification_element'    => ['name' => 'notification_element',     'type' => 'int',      'internal' => 'element'],
        'notification_redirect'   => ['name' => 'notification_redirect',      'type' => 'string',   'internal' => 'redirect'],
        'notification_created_by' => ['name' => 'notification_created_by', 'type' => 'int',      'internal' => 'createdBy', 'readonly' => true],
        'notification_for'        => ['name' => 'notification_for', 'type' => 'int',      'internal' => 'createdFor'],
        'notification_created_at' => ['name' => 'notification_created_at', 'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
        'notification_seen_at'    => ['name' => 'notification_seen_at', 'type' => 'DateTimeImmutable', 'internal' => 'seenAt'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'createdFor' => [
            'mapper'   => AccountMapper::class,
            'external' => 'notification_for',
        ],
        'createdBy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'notification_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'notification';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    public const CREATED_AT = 'notification_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'notification_id';
}
