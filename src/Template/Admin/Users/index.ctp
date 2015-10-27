<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Acts'), ['controller' => 'Acts', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Act'), ['controller' => 'Acts', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?php echo __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('email') ?></th>
                <th><?php echo $this->Paginator->sort('username') ?></th>
                <th><?php echo $this->Paginator->sort('realname') ?></th>
                <th><?php echo $this->Paginator->sort('password') ?></th>
                <th><?php echo $this->Paginator->sort('website') ?></th>
                <th><?php echo $this->Paginator->sort('created') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $this->Number->format($user->id) ?></td>
                <td><?php echo h($user->email) ?></td>
                <td><?php echo h($user->username) ?></td>
                <td><?php echo h($user->realname) ?></td>
                <td><?php echo h($user->password) ?></td>
                <td><?php echo h($user->website) ?></td>
                <td><?php echo h($user->created) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
