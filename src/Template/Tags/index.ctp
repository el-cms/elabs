<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __d('elabs', 'Actions') ?></li>
        <li><?php echo $this->Html->link(__d('elabs', 'New Tag'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__d('elabs', 'List Itemtags'), ['controller' => 'Itemtags', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__d('elabs', 'New Itemtag'), ['controller' => 'Itemtags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tags index large-9 medium-8 columns content">
    <h3><?php echo __d('elabs', 'Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('name') ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?php echo $tag->id ?></td>
                <td><?php echo h($tag->name) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__d('elabs', 'View'), ['action' => 'view', $tag->id]) ?>
                    <?php echo $this->Html->link(__d('elabs', 'Edit'), ['action' => 'edit', $tag->id]) ?>
                    <?php echo $this->Form->postLink(__d('elabs', 'Delete'), ['action' => 'delete', $tag->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $tag->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< ' . __d('elabs', 'previous')) ?>
            <?php echo $this->Paginator->numbers() ?>
            <?php echo $this->Paginator->next(__d('elabs', 'next') . ' >') ?>
        </ul>
        <p><?php echo $this->Paginator->counter() ?></p>
    </div>
</div>
