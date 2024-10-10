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
            <?= $this->Html->link(__('Edit Indicator'), ['action' => 'edit', $indicator->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Indicator'), ['action' => 'delete', $indicator->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicator->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Indicators'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Indicator'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="indicators view content">
            <h3><?= h($indicator->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($indicator->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($indicator->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($indicator->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($indicator->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Analyses') ?></h4>
                <?php if (!empty($indicator->analyses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Public Flg') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($indicator->analyses as $analyses) : ?>
                        <tr>
                            <td><?= h($analyses->id) ?></td>
                            <td><?= h($analyses->name) ?></td>
                            <td><?= h($analyses->description) ?></td>
                            <td><?= h($analyses->public_flg) ?></td>
                            <td><?= h($analyses->created) ?></td>
                            <td><?= h($analyses->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Analyses', 'action' => 'view', $analyses->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Analyses', 'action' => 'edit', $analyses->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Analyses', 'action' => 'delete', $analyses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $analyses->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
