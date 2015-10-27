<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Itemfiles'), ['controller' => 'Itemfiles', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Itemfile'), ['controller' => 'Itemfiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?php echo h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Name') ?></th>
            <td><?php echo h($file->name) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Filename') ?></th>
            <td><?php echo h($file->filename) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Description') ?></th>
            <td><?php echo h($file->description) ?></td>
        </tr>
        <tr>
            <th><?php echo __('User') ?></th>
            <td><?php echo $file->has('user') ? $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Weight') ?></th>
            <td><?php echo $this->Number->format($file->weight) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Created') ?></th>
            <td><?php echo h($file->created) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Modified') ?></th>
            <td><?php echo h($file->modified) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?php echo __('Related Itemfiles') ?></h4>
        <?php if (!empty($file->itemfiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Model') ?></th>
                <th><?php echo __('Fkid') ?></th>
                <th><?php echo __('File Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($file->itemfiles as $itemfiles): ?>
            <tr>
                <td><?php echo h($itemfiles->id) ?></td>
                <td><?php echo h($itemfiles->model) ?></td>
                <td><?php echo h($itemfiles->fkid) ?></td>
                <td><?php echo h($itemfiles->file_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Itemfiles', 'action' => 'view', $itemfiles->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Itemfiles', 'action' => 'edit', $itemfiles->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Itemfiles', 'action' => 'delete', $itemfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemfiles->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
