<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('New File'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Itemfiles'), ['controller' => 'Itemfiles', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Itemfile'), ['controller' => 'Itemfiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="files index large-9 medium-8 columns content">
    <h3><?php echo __('Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('name') ?></th>
                <th><?php echo $this->Paginator->sort('filename') ?></th>
                <th><?php echo $this->Paginator->sort('weight') ?></th>
                <th><?php echo $this->Paginator->sort('description') ?></th>
                <th><?php echo $this->Paginator->sort('created') ?></th>
                <th><?php echo $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo $this->Number->format($file->id) ?></td>
                <td><?php echo h($file->name) ?></td>
                <td><?php echo h($file->filename) ?></td>
                <td><?php echo $this->Number->format($file->weight) ?></td>
                <td><?php echo h($file->description) ?></td>
                <td><?php echo h($file->created) ?></td>
                <td><?php echo h($file->modified) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $file->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $file->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
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
