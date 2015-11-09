<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('New License'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="licenses index large-9 medium-8 columns content">
    <h3><?php echo __('Licenses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('name') ?></th>
                <th><?php echo $this->Paginator->sort('short_description') ?></th>
                <th><?php echo $this->Paginator->sort('link') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($licenses as $license): ?>
            <tr>
                <td><?php echo $license->id ?></td>
                <td><?php echo h($license->name) ?></td>
                <td><?php echo h($license->short_description) ?></td>
                <td><?php echo h($license->link) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $license->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $license->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $license->id], ['confirm' => __('Are you sure you want to delete # {0}?', $license->id)]) ?>
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
