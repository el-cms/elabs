<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Projects Post'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projectsPosts index large-9 medium-8 columns content">
    <h3><?= __('Projects Posts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('post_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projectsPosts as $projectsPost): ?>
            <tr>
                <td><?= $this->Number->format($projectsPost->id) ?></td>
                <td><?= $projectsPost->has('project') ? $this->Html->link($projectsPost->project->name, ['controller' => 'Projects', 'action' => 'view', $projectsPost->project->id]) : '' ?></td>
                <td><?= $projectsPost->has('post') ? $this->Html->link($projectsPost->post->title, ['controller' => 'Posts', 'action' => 'view', $projectsPost->post->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $projectsPost->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectsPost->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectsPost->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsPost->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
