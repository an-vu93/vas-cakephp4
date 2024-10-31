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
                    <th><?= __('Active') ?></th>
                    <td><?= $this->Number->format($indicator->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percentile 20') ?></th>
                    <td><?= $this->Number->format($indicator->percentile_20) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percentile 40') ?></th>
                    <td><?= $this->Number->format($indicator->percentile_40) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percentile 60') ?></th>
                    <td><?= $this->Number->format($indicator->percentile_60) ?></td>
                </tr>
                <tr>
                    <th><?= __('Percentile 80') ?></th>
                    <td><?= $this->Number->format($indicator->percentile_80) ?></td>
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
            <div class="text">
                <strong><?= __('Query') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($indicator->query)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Customer Scores') ?></h4>
                <?php if (!empty($indicator->customer_scores)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Indicator Id') ?></th>
                            <th><?= __('Indicator Score') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($indicator->customer_scores as $customerScores) : ?>
                        <tr>
                            <td><?= h($customerScores->id) ?></td>
                            <td><?= h($customerScores->customer_id) ?></td>
                            <td><?= h($customerScores->indicator_id) ?></td>
                            <td><?= h($customerScores->indicator_score) ?></td>
                            <td><?= h($customerScores->created) ?></td>
                            <td><?= h($customerScores->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CustomerScores', 'action' => 'view', $customerScores->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CustomerScores', 'action' => 'edit', $customerScores->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CustomerScores', 'action' => 'delete', $customerScores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerScores->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Indicator Weights') ?></h4>
                <?php if (!empty($indicator->indicator_weights)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Analysis Id') ?></th>
                            <th><?= __('Indicator Id') ?></th>
                            <th><?= __('Weight') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($indicator->indicator_weights as $indicatorWeights) : ?>
                        <tr>
                            <td><?= h($indicatorWeights->id) ?></td>
                            <td><?= h($indicatorWeights->analysis_id) ?></td>
                            <td><?= h($indicatorWeights->indicator_id) ?></td>
                            <td><?= h($indicatorWeights->weight) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'IndicatorWeights', 'action' => 'view', $indicatorWeights->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'IndicatorWeights', 'action' => 'edit', $indicatorWeights->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'IndicatorWeights', 'action' => 'delete', $indicatorWeights->id], ['confirm' => __('Are you sure you want to delete # {0}?', $indicatorWeights->id)]) ?>
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
