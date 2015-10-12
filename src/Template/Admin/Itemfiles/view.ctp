<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Itemfile'), ['action' => 'edit', $itemfile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Itemfile'), ['action' => 'delete', $itemfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemfile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Itemfiles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Itemfile'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemfiles view large-9 medium-8 columns content">
    <h3><?= h($itemfile->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model') ?></th>
            <td><?= h($itemfile->model) ?></td>
        </tr>
        <tr>
            <th><?= __('File') ?></th>
            <td><?= $itemfile->has('file') ? $this->Html->link($itemfile->file->name, ['controller' => 'Files', 'action' => 'view', $itemfile->file->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemfile->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fkid') ?></th>
            <td><?= $this->Number->format($itemfile->fkid) ?></td>
        </tr>
    </table>
</div>
