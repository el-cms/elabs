<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Projects Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projectsTags index large-9 medium-8 columns content">
    <h3><?= __('Projects Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('tag_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projectsTags as $projectsTag): ?>
            <tr>
                <td><?= $this->Number->format($projectsTag->id) ?></td>
                <td><?= $projectsTag->has('project') ? $this->Html->link($projectsTag->project->name, ['controller' => 'Projects', 'action' => 'view', $projectsTag->project->id]) : '' ?></td>
                <td><?= $projectsTag->has('tag') ? $this->Html->link($projectsTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $projectsTag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $projectsTag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectsTag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectsTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsTag->id)]) ?>
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
