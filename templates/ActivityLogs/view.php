<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityLog $activityLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Activity Log'), ['action' => 'edit', $activityLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Activity Log'), ['action' => 'delete', $activityLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Activity Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Activity Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="activityLogs view content">
            <h3><?= h($activityLog->employee_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Employee Name') ?></th>
                    <td><?= h($activityLog->employee_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Action') ?></th>
                    <td><?= h($activityLog->action) ?></td>
                </tr>
                <tr>
                    <th><?= __('Controller') ?></th>
                    <td><?= h($activityLog->controller) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($activityLog->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ip Address') ?></th>
                    <td><?= h($activityLog->ip_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($activityLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee Number') ?></th>
                    <td><?= $this->Number->format($activityLog->employee_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($activityLog->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($activityLog->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
