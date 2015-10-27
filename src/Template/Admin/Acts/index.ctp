<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('New Act'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acts index large-9 medium-8 columns content">
    <h3><?php echo __('Acts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('model') ?></th>
                <th><?php echo $this->Paginator->sort('fkid') ?></th>
                <th><?php echo $this->Paginator->sort('type') ?></th>
                <th><?php echo $this->Paginator->sort('user_id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($acts as $act): ?>
            <tr>
                <td><?php echo $this->Number->format($act->id) ?></td>
                <td><?php echo h($act->model) ?></td>
                <td><?php echo $this->Number->format($act->fkid) ?></td>
                <td><?php echo h($act->type) ?></td>
                <td><?php echo $act->has('user') ? $this->Html->link($act->user->username, ['controller' => 'Users', 'action' => 'view', $act->user->id]) : '' ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $act->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $act->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $act->id], ['confirm' => __('Are you sure you want to delete # {0}?', $act->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
            <?php echo $this->Paginator->numbers() ?>
            <?php echo $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?php echo $this->Paginator->counter() ?></p>
    </div>
</div>
