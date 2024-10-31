<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IndicatorWeight $indicatorWeight
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Indicator Weight'), ['action' => 'edit', $indicatorWeight->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Indicator Weight'), ['action' => 'delete', $indicatorWeight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicatorWeight->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Indicator Weights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Indicator Weight'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indicatorWeights view content">
            <h3><?= h($indicatorWeight->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Analysis') ?></th>
                    <td><?= $indicatorWeight->has('analysis') ? $this->Html->link($indicatorWeight->analysis->name, ['controller' => 'Analyses', 'action' => 'view', $indicatorWeight->analysis->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Indicator') ?></th>
                    <td><?= $indicatorWeight->has('indicator') ? $this->Html->link($indicatorWeight->indicator->name, ['controller' => 'Indicators', 'action' => 'view', $indicatorWeight->indicator->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($indicatorWeight->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $this->Number->format($indicatorWeight->weight) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
