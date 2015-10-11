<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Act'), ['action' => 'edit', $act->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Act'), ['action' => 'delete', $act->id], ['confirm' => __('Are you sure you want to delete # {0}?', $act->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Act'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="acts view large-9 medium-8 columns content">
    <h3><?= h($act->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model') ?></th>
            <td><?= h($act->model) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($act->type) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $act->has('user') ? $this->Html->link($act->user->username, ['controller' => 'Users', 'action' => 'view', $act->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($act->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fkid') ?></th>
            <td><?= $this->Number->format($act->fkid) ?></td>
        </tr>
    </table>
</div>
