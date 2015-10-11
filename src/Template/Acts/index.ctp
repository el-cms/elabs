<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Act'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acts index large-9 medium-8 columns content">
    <h3><?= __('Acts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('model') ?></th>
                <th><?= $this->Paginator->sort('fkid') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($acts as $act): ?>
            <tr>
                <td><?= $this->Number->format($act->id) ?></td>
                <td><?= h($act->model) ?></td>
                <td><?= $this->Number->format($act->fkid) ?></td>
                <td><?= h($act->type) ?></td>
                <td><?= $act->has('user') ? $this->Html->link($act->user->username, ['controller' => 'Users', 'action' => 'view', $act->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $act->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $act->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $act->id], ['confirm' => __('Are you sure you want to delete # {0}?', $act->id)]) ?>
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
