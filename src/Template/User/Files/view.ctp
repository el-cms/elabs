<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Itemfiles'), ['controller' => 'Itemfiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Itemfile'), ['controller' => 'Itemfiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Filename') ?></th>
            <td><?= h($file->filename) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($file->description) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $file->has('user') ? $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight') ?></th>
            <td><?= $this->Number->format($file->weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($file->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($file->modified) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Itemfiles') ?></h4>
        <?php if (!empty($file->itemfiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Model') ?></th>
                <th><?= __('Fkid') ?></th>
                <th><?= __('File Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($file->itemfiles as $itemfiles): ?>
            <tr>
                <td><?= h($itemfiles->id) ?></td>
                <td><?= h($itemfiles->model) ?></td>
                <td><?= h($itemfiles->fkid) ?></td>
                <td><?= h($itemfiles->file_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Itemfiles', 'action' => 'view', $itemfiles->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Itemfiles', 'action' => 'edit', $itemfiles->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Itemfiles', 'action' => 'delete', $itemfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemfiles->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
