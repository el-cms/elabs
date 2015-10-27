<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit Act'), ['action' => 'edit', $act->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Act'), ['action' => 'delete', $act->id], ['confirm' => __('Are you sure you want to delete # {0}?', $act->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Acts'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Act'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="acts view large-9 medium-8 columns content">
    <h3><?php echo h($act->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Model') ?></th>
            <td><?php echo h($act->model) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Type') ?></th>
            <td><?php echo h($act->type) ?></td>
        </tr>
        <tr>
            <th><?php echo __('User') ?></th>
            <td><?php echo $act->has('user') ? $this->Html->link($act->user->username, ['controller' => 'Users', 'action' => 'view', $act->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($act->id) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Fkid') ?></th>
            <td><?php echo $this->Number->format($act->fkid) ?></td>
        </tr>
    </table>
</div>
