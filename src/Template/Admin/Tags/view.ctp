<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Tags'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Tag'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Itemtags'), ['controller' => 'Itemtags', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Itemtag'), ['controller' => 'Itemtags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-9 medium-8 columns content">
    <h3><?php echo h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Name') ?></th>
            <td><?php echo h($tag->name) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($tag->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?php echo __('Related Itemtags') ?></h4>
        <?php if (!empty($tag->itemtags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Model') ?></th>
                <th><?php echo __('Fkid') ?></th>
                <th><?php echo __('Tag Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($tag->itemtags as $itemtags): ?>
            <tr>
                <td><?php echo h($itemtags->id) ?></td>
                <td><?php echo h($itemtags->model) ?></td>
                <td><?php echo h($itemtags->fkid) ?></td>
                <td><?php echo h($itemtags->tag_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Itemtags', 'action' => 'view', $itemtags->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Itemtags', 'action' => 'edit', $itemtags->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Itemtags', 'action' => 'delete', $itemtags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemtags->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
