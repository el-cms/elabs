<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teams Project'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teamsProjects index large-9 medium-8 columns content">
    <h3><?= __('Teams Projects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('team_id') ?></th>
                <th><?= $this->Paginator->sort('project_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teamsProjects as $teamsProject): ?>
            <tr>
                <td><?= $this->Number->format($teamsProject->id) ?></td>
                <td><?= $teamsProject->has('team') ? $this->Html->link($teamsProject->team->name, ['controller' => 'Teams', 'action' => 'view', $teamsProject->team->id]) : '' ?></td>
                <td><?= $teamsProject->has('project') ? $this->Html->link($teamsProject->project->name, ['controller' => 'Projects', 'action' => 'view', $teamsProject->project->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teamsProject->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teamsProject->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teamsProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamsProject->id)]) ?>
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
