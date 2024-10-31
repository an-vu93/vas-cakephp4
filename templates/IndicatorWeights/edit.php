<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IndicatorWeight $indicatorWeight
 * @var string[]|\Cake\Collection\CollectionInterface $analyses
 * @var string[]|\Cake\Collection\CollectionInterface $indicators
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $indicatorWeight->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $indicatorWeight->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Indicator Weights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indicatorWeights form content">
            <?= $this->Form->create($indicatorWeight) ?>
            <fieldset>
                <legend><?= __('Edit Indicator Weight') ?></legend>
                <?php
                    echo $this->Form->control('analysis_id', ['options' => $analyses]);
                    echo $this->Form->control('indicator_id', ['options' => $indicators]);
                    echo $this->Form->control('weight');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
