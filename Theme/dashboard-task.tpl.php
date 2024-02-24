<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Tasks
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Tasks\Models\TaskPriority;
use phpOMS\Uri\UriFactory;

$notificationList = $this->data['notification'] ?? [];
?>

<div id="notification-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <div class="portlet">
        <div class="portlet-head"><?= $this->getHtml('Tasks', 'Tasks'); ?></div>
        <div class="slider">
        <table class="default sticky">
            <thead>
                <td><?= $this->getHtml('Status', 'Tasks'); ?>
                <td><?= $this->getHtml('Due/Priority', 'Tasks'); ?>
                <td class="wf-100"><?= $this->getHtml('Title', 'Tasks'); ?>
            <tfoot>
            <tbody>
            <?php
            $c = 0;
            foreach ($notificationList as $key => $notification) : ++$c;
                $url = UriFactory::build(empty($notification->redirect)
                    ? '{/base}/notification/view?{?}&id=' . $notification->id
                    : ($notification->redirect)
                );
            ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>">
                        <span class="tag <?= $this->printHtml('notification-status-' . $notification->status); ?>">
                            <?= $this->getHtml('S' . $notification->status, 'Tasks'); ?>
                        </span></a>
                    <td><a href="<?= $url; ?>">
                        <?php if ($notification->priority === TaskPriority::NONE) : ?>
                            <?= $this->printHtml($notification->due->format('Y-m-d H:i')); ?>
                        <?php else : ?>
                            <?= $this->getHtml('P' . $notification->priority); ?>
                        <?php endif; ?>
                        </a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($notification->title); ?></a>
            <?php endforeach; ?>
            <?php if ($c == 0) : ?>
            <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
        </div>
        <div class="portlet-foot">
            <a class="button" href="<?= UriFactory::build('{/base}/notification/dashboard?{?}'); ?>"><?= $this->getHtml('More', '0', '0'); ?></a>
        </div>
    </div>
</div>