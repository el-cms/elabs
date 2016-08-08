<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Projects File'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projectsFiles index large-9 medium-8 columns content">
    <h3><?= __('Projects Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th><?= $this->Paginator->sort('file_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projectsFiles as $projectsFile): ?>
            <tr>
                <td><?= $this->Number->format($projectsFile->id) ?></td>
                <td><?= $projectsFile->has('project') ? $this->Html->link($projectsFile->project->name, ['controller' => 'Projects', 'action' => 'view', $projectsFile->project->id]) : '' ?></td>
                <td><?= $projectsFile->has('file') ? $this->Html->link($projectsFile->file->name, ['controller' => 'Files', 'action' => 'view', $projectsFile->file->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $projectsFile->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projectsFile->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $projectsFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsFile->id)]) ?>
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
