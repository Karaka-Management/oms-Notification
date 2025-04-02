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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;

/**
 * Notification class.
 *
 * @package Modules\Notification\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Notification implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    public string $title = '';

    /**
     * Redirect.
     *
     * Used as reference or for redirection when opened.
     * This allows to open the task on a different page with a different layout if needed (e.g. ticket system, workflow, checklist, ...)
     *
     * @var string
     * @since 1.0.0
     */
    public string $redirect = '';

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdBy;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdFor;

    /**
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public ?\DateTimeImmutable $seenAt = null;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Description raw.
     *
     * @var string
     * @since 1.0.0
     */
    public string $descriptionRaw = '';

    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    public int $type = NotificationType::CREATE;

    /**
     * Status.
     *
     * @var int
     * @since 1.0.0
     */
    public int $status = NotificationStatus::DEFAULT;

    public int $category = 0;

    public int $element = 0;

    public string $module = '';

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy  = new NullAccount();
        $this->createdFor = new NullAccount();
        $this->createdAt  = new \DateTimeImmutable('now');
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'             => $this->id,
            'createdBy'      => $this->createdBy,
            'createdAt'      => $this->createdAt,
            'title'          => $this->title,
            'description'    => $this->description,
            'descriptionRaw' => $this->descriptionRaw,
            'status'         => $this->status,
            'type'           => $this->type,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
