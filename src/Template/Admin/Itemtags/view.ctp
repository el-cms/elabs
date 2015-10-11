<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Itemtag'), ['action' => 'edit', $itemtag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Itemtag'), ['action' => 'delete', $itemtag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemtag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Itemtags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Itemtag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemtags view large-9 medium-8 columns content">
    <h3><?= h($itemtag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Model') ?></th>
            <td><?= h($itemtag->model) ?></td>
        </tr>
        <tr>
            <th><?= __('Tag') ?></th>
            <td><?= $itemtag->has('tag') ? $this->Html->link($itemtag->tag->name, ['controller' => 'Tags', 'action' => 'view', $itemtag->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemtag->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fkid') ?></th>
            <td><?= $this->Number->format($itemtag->fkid) ?></td>
        </tr>
    </table>
</div>
