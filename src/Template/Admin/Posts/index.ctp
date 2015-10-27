<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('New Post'), ['action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posts index large-9 medium-8 columns content">
    <h3><?php echo __('Posts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id') ?></th>
                <th><?php echo $this->Paginator->sort('title') ?></th>
                <th><?php echo $this->Paginator->sort('excerpt') ?></th>
                <th><?php echo $this->Paginator->sort('sfw') ?></th>
                <th><?php echo $this->Paginator->sort('anon') ?></th>
                <th><?php echo $this->Paginator->sort('created') ?></th>
                <th><?php echo $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $this->Number->format($post->id) ?></td>
                <td><?php echo h($post->title) ?></td>
                <td><?php echo h($post->excerpt) ?></td>
                <td><?php echo h($post->sfw) ?></td>
                <td><?php echo h($post->anon) ?></td>
                <td><?php echo h($post->created) ?></td>
                <td><?php echo h($post->modified) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $post->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
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
