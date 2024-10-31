<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\IndicatorWeight> $indicatorWeights
 */
?>
<div class="indicatorWeights index content">
    <?= $this->Html->link(__('New Indicator Weight'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Indicator Weights') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('analysis_id') ?></th>
                    <th><?= $this->Paginator->sort('indicator_id') ?></th>
                    <th><?= $this->Paginator->sort('weight') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($indicatorWeights as $indicatorWeight): ?>
                <tr>
                    <td><?= $this->Number->format($indicatorWeight->id) ?></td>
                    <td><?= $indicatorWeight->has('analysis') ? $this->Html->link($indicatorWeight->analysis->name, ['controller' => 'Analyses', 'action' => 'view', $indicatorWeight->analysis->id]) : '' ?></td>
                    <td><?= $indicatorWeight->has('indicator') ? $this->Html->link($indicatorWeight->indicator->name, ['controller' => 'Indicators', 'action' => 'view', $indicatorWeight->indicator->id]) : '' ?></td>
                    <td><?= $this->Number->format($indicatorWeight->weight) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $indicatorWeight->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $indicatorWeight->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $indicatorWeight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicatorWeight->id)]) ?>
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
