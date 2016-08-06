<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notes Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notes'), ['controller' => 'Notes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note'), ['controller' => 'Notes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notesTags index large-9 medium-8 columns content">
    <h3><?= __('Notes Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('note_id') ?></th>
                <th><?= $this->Paginator->sort('tag_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notesTags as $notesTag): ?>
            <tr>
                <td><?= $this->Number->format($notesTag->id) ?></td>
                <td><?= $notesTag->has('note') ? $this->Html->link($notesTag->note->id, ['controller' => 'Notes', 'action' => 'view', $notesTag->note->id]) : '' ?></td>
                <td><?= $notesTag->has('tag') ? $this->Html->link($notesTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $notesTag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notesTag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notesTag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notesTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notesTag->id)]) ?>
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
