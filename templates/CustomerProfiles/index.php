<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CustomerProfile> $customerProfiles
 */
?>
<div class="customerProfiles index content">
    <?= $this->Html->link(__('New Customer Profile'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Customer Profiles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('customer_id') ?></th>
                    <th><?= $this->Paginator->sort('corporate_number') ?></th>
                    <th><?= $this->Paginator->sort('hw_business_number') ?></th>
                    <th><?= $this->Paginator->sort('employee_number') ?></th>
                    <th><?= $this->Paginator->sort('capital') ?></th>
                    <th><?= $this->Paginator->sort('revenue') ?></th>
                    <th><?= $this->Paginator->sort('recruiting_flg') ?></th>
                    <th><?= $this->Paginator->sort('ignore_flg') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('prefecture_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customerProfiles as $customerProfile): ?>
                <tr>
                    <td><?= $this->Number->format($customerProfile->id) ?></td>
                    <td><?= $customerProfile->has('customer') ? $this->Html->link($customerProfile->customer->name, ['controller' => 'Customers', 'action' => 'view', $customerProfile->customer->id]) : '' ?></td>
                    <td><?= $customerProfile->corporate_number === null ? '' : $this->Number->format($customerProfile->corporate_number) ?></td>
                    <td><?= $customerProfile->hw_business_number === null ? '' : $this->Number->format($customerProfile->hw_business_number) ?></td>
                    <td><?= $customerProfile->employee_number === null ? '' : $this->Number->format($customerProfile->employee_number) ?></td>
                    <td><?= $customerProfile->capital === null ? '' : $this->Number->format($customerProfile->capital) ?></td>
                    <td><?= $customerProfile->revenue === null ? '' : $this->Number->format($customerProfile->revenue) ?></td>
                    <td><?= $customerProfile->recruiting_flg === null ? '' : $this->Number->format($customerProfile->recruiting_flg) ?></td>
                    <td><?= $customerProfile->ignore_flg === null ? '' : $this->Number->format($customerProfile->ignore_flg) ?></td>
                    <td><?= h($customerProfile->created) ?></td>
                    <td><?= h($customerProfile->modified) ?></td>
                    <td><?= $customerProfile->has('prefecture') ? $this->Html->link($customerProfile->prefecture->name, ['controller' => 'Prefectures', 'action' => 'view', $customerProfile->prefecture->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customerProfile->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customerProfile->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customerProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerProfile->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
