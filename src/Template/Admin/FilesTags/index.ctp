<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Files Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="filesTags index large-9 medium-8 columns content">
    <h3><?= __('Files Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('file_id') ?></th>
                <th><?= $this->Paginator->sort('tag_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filesTags as $filesTag): ?>
            <tr>
                <td><?= $this->Number->format($filesTag->id) ?></td>
                <td><?= $filesTag->has('file') ? $this->Html->link($filesTag->file->name, ['controller' => 'Files', 'action' => 'view', $filesTag->file->id]) : '' ?></td>
                <td><?= $filesTag->has('tag') ? $this->Html->link($filesTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $filesTag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $filesTag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $filesTag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $filesTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filesTag->id)]) ?>
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
