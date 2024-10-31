<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IndicatorWeight $indicatorWeight
 * @var \Cake\Collection\CollectionInterface|string[] $analyses
 * @var \Cake\Collection\CollectionInterface|string[] $indicators
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Indicator Weights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indicatorWeights form content">
            <?= $this->Form->create($indicatorWeight) ?>
            <fieldset>
                <legend><?= __('Add Indicator Weight') ?></legend>
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
