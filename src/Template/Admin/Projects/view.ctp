<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit Project'), ['action' => 'edit', $project->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Project'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Projects'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Project'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Project Users'), ['controller' => 'ProjectUsers', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Project User'), ['controller' => 'ProjectUsers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projects view large-9 medium-8 columns content">
    <h3><?php echo h($project->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Name') ?></th>
            <td><?php echo h($project->name) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Short Description') ?></th>
            <td><?php echo h($project->short_description) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Download') ?></th>
            <td><?php echo h($project->download) ?></td>
        </tr>
        <tr>
            <th><?php echo __('License') ?></th>
            <td><?php echo $project->has('license') ? $this->Html->link($project->license->name, ['controller' => 'Licenses', 'action' => 'view', $project->license->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('User') ?></th>
            <td><?php echo $project->has('user') ? $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Created') ?></th>
            <td><?php echo h($project->created) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Modified') ?></th>
            <td><?php echo h($project->modified) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Sfw') ?></th>
            <td><?php echo $project->sfw ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?php echo __('Description') ?></h4>
        <?php echo $this->Text->autoParagraph(h($project->description)); ?>
    </div>
    <div class="related">
        <h4><?php echo __('Related Project Users') ?></h4>
        <?php if (!empty($project->project_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th><?php echo __('Project Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($project->project_users as $projectUsers): ?>
            <tr>
                <td><?php echo h($projectUsers->id) ?></td>
                <td><?php echo h($projectUsers->user_id) ?></td>
                <td><?php echo h($projectUsers->project_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'ProjectUsers', 'action' => 'view', $projectUsers->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'ProjectUsers', 'action' => 'edit', $projectUsers->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'ProjectUsers', 'action' => 'delete', $projectUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectUsers->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
