<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerProfile $customerProfile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Customer Profile'), ['action' => 'edit', $customerProfile->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Customer Profile'), ['action' => 'delete', $customerProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerProfile->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Customer Profiles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Customer Profile'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customerProfiles view content">
            <h3><?= h($customerProfile->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td><?= $customerProfile->has('customer') ? $this->Html->link($customerProfile->customer->name, ['controller' => 'Customers', 'action' => 'view', $customerProfile->customer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Prefecture') ?></th>
                    <td><?= $customerProfile->has('prefecture') ? $this->Html->link($customerProfile->prefecture->name, ['controller' => 'Prefectures', 'action' => 'view', $customerProfile->prefecture->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customerProfile->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Corporate Number') ?></th>
                    <td><?= $customerProfile->corporate_number === null ? '' : $this->Number->format($customerProfile->corporate_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hw Business Number') ?></th>
                    <td><?= $customerProfile->hw_business_number === null ? '' : $this->Number->format($customerProfile->hw_business_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Employee Number') ?></th>
                    <td><?= $customerProfile->employee_number === null ? '' : $this->Number->format($customerProfile->employee_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Capital') ?></th>
                    <td><?= $customerProfile->capital === null ? '' : $this->Number->format($customerProfile->capital) ?></td>
                </tr>
                <tr>
                    <th><?= __('Revenue') ?></th>
                    <td><?= $customerProfile->revenue === null ? '' : $this->Number->format($customerProfile->revenue) ?></td>
                </tr>
                <tr>
                    <th><?= __('Recruiting Flg') ?></th>
                    <td><?= $customerProfile->recruiting_flg === null ? '' : $this->Number->format($customerProfile->recruiting_flg) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ignore Flg') ?></th>
                    <td><?= $customerProfile->ignore_flg === null ? '' : $this->Number->format($customerProfile->ignore_flg) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($customerProfile->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($customerProfile->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Remark') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($customerProfile->remark)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
