<?php
$this->assign('title', __d('projects', 'Project: {0}', h($project->name)));

$this->start('pageInfos');
if ($project->has('mainurl')):
echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-external-link"></span>',__d('elabs', 'Website')]),$project->mainurl, ['escape'=>false, 'class'=>'btn btn-default']);
endif; ?>
<dl>
    <dt><?php echo __d('elabs', 'License') ?></dt>
    <dd><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $project->license->icon . '"></span>', $project->license->name]), ['controller' => 'Licenses', 'action' => 'view', $project->license->id], ['escape' => false]) ?></dd>
    <dt><?php echo __d('elabs', 'Created on') ?></dt>
    <dd><?php echo h($project->created) ?></tr>
        <?php if ($project->has('modified')): ?>
        <dt><?php echo __d('elabs', 'Modified on') ?></dt>
        <dd><?php echo h($project->modified) ?></tr>
        <?php endif; ?>
    <dt><?php echo __d('elabs', 'Safe content') ?></dt>
    <dd><span class="label label-<?php echo $project->sfw ? 'green' : 'red'; ?>"><?php echo $project->sfw ? __('Yes') : __('No'); ?></span></dd>
    <dt><?php echo __d('elabs', 'Tags') ?></dt>
    <dd><?php echo $this->element('layout/dev_inline') ?></dd>
</dl>

<div class="content-sub-heading"><?php echo __d('elabs', 'Members') ?></div>
<ul>
    <li><?php echo $project->has('user') ? $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></li>
    <?php if ($project->project_users): ?>

        <?php foreach ($project->project_users as $projectUsers): ?>
            <li><?php echo $this->Html->link(h($projectUsers->id), ['controller' => 'ProjectUsers', 'action' => 'view', $projectUsers->id]) ?></li>  
        <?php endforeach; ?>

    <?php endif; ?>
    <li><?php echo $this->element('layout/dev_inline') ?></li>
</ul>
<?php
$this->end();

$this->start('pageContent');

echo $this->Elabs->displayMD($project->short_description);
?>
<hr />
<?php
echo $this->Elabs->displayMD($project->description);

echo $this->element('layout/loader_prism');

$this->end();

echo $this->element('layouts/defaultview');
