<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __d('elabs', 'Actions') ?></li>
        <li><?php echo $this->Html->link(__d('elabs', 'Edit Tag'), ['action' => 'edit', $tag->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__d('elabs', 'Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $tag->id)]) ?> </li>
        <li><?php echo $this->Html->link(__d('elabs', 'List Tags'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__d('elabs', 'New Tag'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__d('elabs', 'List Itemtags'), ['controller' => 'Itemtags', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__d('elabs', 'New Itemtag'), ['controller' => 'Itemtags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tags view large-9 medium-8 columns content">
    <h3><?php echo h($tag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __d('elabs', 'Name') ?></th>
            <td><?php echo h($tag->name) ?></td>
        </tr>
        <tr>
            <th><?php echo __d('elabs', 'Id') ?></th>
            <td><?php echo $tag->id ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?php echo __d('elabs', 'Related Itemtags') ?></h4>
        <?php if (!empty($tag->itemtags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __d('elabs', 'Id') ?></th>
                <th><?php echo __d('elabs', 'Model') ?></th>
                <th><?php echo __d('elabs', 'Fkid') ?></th>
                <th><?php echo __d('elabs', 'Tag Id') ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
            <?php foreach ($tag->itemtags as $itemtags): ?>
            <tr>
                <td><?php echo h($itemtags->id) ?></td>
                <td><?php echo h($itemtags->model) ?></td>
                <td><?php echo h($itemtags->fkid) ?></td>
                <td><?php echo h($itemtags->tag_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__d('elabs', 'View'), ['controller' => 'Itemtags', 'action' => 'view', $itemtags->id]) ?>

                    <?php echo $this->Html->link(__d('elabs', 'Edit'), ['controller' => 'Itemtags', 'action' => 'edit', $itemtags->id]) ?>

                    <?php echo $this->Form->postLink(__d('elabs', 'Delete'), ['controller' => 'Itemtags', 'action' => 'delete', $itemtags->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $itemtags->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
