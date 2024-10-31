<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Indicator $indicator
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Indicators'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indicators form content">
            <?= $this->Form->create($indicator) ?>
            <fieldset>
                <legend><?= __('Add Indicator') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('query');
                    echo $this->Form->control('active');
                    echo $this->Form->control('percentile_20');
                    echo $this->Form->control('percentile_40');
                    echo $this->Form->control('percentile_60');
                    echo $this->Form->control('percentile_80');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
