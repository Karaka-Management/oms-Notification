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

use phpOMS\Uri\UriFactory;

$notifications = $this->data['notifications'] ?? [];
?>

<div id="notification-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <section class="portlet">
        <div class="portlet-head"><?= $this->getHtml('Notifications', 'Notification'); ?></div>
        <div class="slider">
        <table class="default sticky">
            <thead>
            <tr>
                <td><?= $this->getHtml('Date', 'Notification'); ?>
                <td>
                <td class="wf-100"><?= $this->getHtml('Title', 'Notification'); ?>
            <tbody>
            <?php
                $c = 0;
                foreach ($notifications as $notification) : ++$c;
                $url = UriFactory::build($notification->redirect);
            ?>
            <tr data-href="<?= $url; ?>">
                <td><a href="<?= $url; ?>"><?= $notification->createdAt->format('Y-m-d'); ?></a>
                <td><a href="<?= $url; ?>"><?= $this->getHtml(':status-' . $notification->type); ?></a>
                <td><a href="<?= $url; ?>"><?= $this->printHtml($notification->module); ?>: <?= $this->printHtml($notification->title); ?></a>
            <?php endforeach; ?>
            <?php if ($c === 0) : ?>
            <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
        </div>
        <div class="portlet-foot">
            <a class="button" href="<?= UriFactory::build('{/base}/notification/dashboard?{?}'); ?>"><?= $this->getHtml('More', '0', '0'); ?></a>
            <span class="end-xs">
                <form id="iNotificationRead" action="<?= \phpOMS\Uri\UriFactory::build('{/api}notification/seen?{?}&csrf={$CSRF}'); ?>" method="POST">
                    <input type="submit" class="end-xs save" value="<?= $this->getHtml('MarkSeen', 'Notification'); ?>">
                </form>
            </span>
        </div>
    </section>
</div>