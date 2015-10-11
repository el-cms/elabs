<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Itemtag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemtags index large-9 medium-8 columns content">
    <h3><?= __('Itemtags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('model') ?></th>
                <th><?= $this->Paginator->sort('fkid') ?></th>
                <th><?= $this->Paginator->sort('tag_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemtags as $itemtag): ?>
            <tr>
                <td><?= $this->Number->format($itemtag->id) ?></td>
                <td><?= h($itemtag->model) ?></td>
                <td><?= $this->Number->format($itemtag->fkid) ?></td>
                <td><?= $itemtag->has('tag') ? $this->Html->link($itemtag->tag->name, ['controller' => 'Tags', 'action' => 'view', $itemtag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemtag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemtag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemtag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemtag->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
