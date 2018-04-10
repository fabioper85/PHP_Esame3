<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sample[]|\Cake\Collection\CollectionInterface $samples
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sample'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sensors'), ['controller' => 'Sensors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sensor'), ['controller' => 'Sensors', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="samples index large-9 medium-8 columns content">
    <h3><?= __('Samples') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sensor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datetime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($samples as $sample): ?>
            <tr>
                <td><?= $this->Number->format($sample->id) ?></td>
                <td><?= $sample->has('sensor') ? $this->Html->link($sample->sensor->id, ['controller' => 'Sensors', 'action' => 'view', $sample->sensor->id]) : '' ?></td>
                <td><?= h($sample->datetime) ?></td>
                <td><?= $this->Number->format($sample->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sample->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sample->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sample->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sample->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
