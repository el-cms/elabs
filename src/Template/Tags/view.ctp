<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Itemtags'), ['controller' => 'Itemtags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Itemtag'), ['controller' => 'Itemtags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-9 medium-8 columns content">
    <h3><?= h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($tag->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tag->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Itemtags') ?></h4>
        <?php if (!empty($tag->itemtags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Model') ?></th>
                <th><?= __('Fkid') ?></th>
                <th><?= __('Tag Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->itemtags as $itemtags): ?>
            <tr>
                <td><?= h($itemtags->id) ?></td>
                <td><?= h($itemtags->model) ?></td>
                <td><?= h($itemtags->fkid) ?></td>
                <td><?= h($itemtags->tag_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Itemtags', 'action' => 'view', $itemtags->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Itemtags', 'action' => 'edit', $itemtags->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Itemtags', 'action' => 'delete', $itemtags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemtags->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
