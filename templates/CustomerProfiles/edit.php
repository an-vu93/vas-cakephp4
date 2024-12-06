<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerProfile $customerProfile
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $prefectures
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customerProfile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customerProfile->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Customer Profiles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customerProfiles form content">
            <?= $this->Form->create($customerProfile) ?>
            <fieldset>
                <legend><?= __('Edit Customer Profile') ?></legend>
                <?php
                    echo $this->Form->control('customer_id', ['options' => $customers, 'empty' => true]);
                    echo $this->Form->control('corporate_number');
                    echo $this->Form->control('hw_business_number');
                    echo $this->Form->control('employee_number');
                    echo $this->Form->control('capital');
                    echo $this->Form->control('revenue');
                    echo $this->Form->control('recruiting_flg');
                    echo $this->Form->control('ignore_flg');
                    echo $this->Form->control('remark');
                    echo $this->Form->control('prefecture_id', ['options' => $prefectures, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
