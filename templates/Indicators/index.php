<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Indicator> $indicators
 */
?>
<div class="indicators index content">
    <?= $this->Html->link(__('New Indicator'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Indicators') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($indicators as $indicator): ?>
                <tr>
                    <td><?= $this->Number->format($indicator->id) ?></td>
                    <td><?= h($indicator->name) ?></td>
                    <td><?= h($indicator->created) ?></td>
                    <td><?= h($indicator->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $indicator->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $indicator->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $indicator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicator->id)]) ?>
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
