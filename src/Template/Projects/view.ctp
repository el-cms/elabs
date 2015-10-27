<?php
$this->assign('title', h($project->name));

$this->start('pageInfos');
?>
<dl>
  <dt><?php echo __('Download link') ?></dt>
  <dd><?php echo h($project->download) ?></dd>
  <dt><?php echo __('License') ?></dt>
  <dd><?php echo $project->has('license') ? $this->Html->link($project->license->name, ['controller' => 'Licenses', 'action' => 'view', $project->license->id]) : '' ?></dd>
  <dt><?php echo __('Created on') ?></dt>
  <dd><?php echo h($project->created) ?></tr>
  <dt><?php echo __('Modified on') ?></dt>
  <dd><?php echo h($project->modified) ?></tr>
  <dt><?php echo __('Safe content') ?></dt>
  <dd class="label label-<?php echo $project->sfw ? 'green' : 'red'; ?>"><?php echo $project->sfw ? __('Yes') : __('No'); ?></dd>
</dl>

<div class="content-sub-heading"><?php echo __('Members') ?></div>
<ul>
  <li><?php echo $project->has('user') ? $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></li>
  <?php if (!empty($project->project_users)): ?>

      <?php foreach ($project->project_users as $projectUsers): ?>
          <li><?php echo $this->Html->link(h($projectUsers->id), ['controller' => 'ProjectUsers', 'action' => 'view', $projectUsers->id]) ?></li>  
      <?php endforeach; ?>

  <?php endif; ?>
</ul>
<?php
$this->end();

$this->start('pageContent');

$this->Markdown->transform($project->short_description);
?>
<hr />
<?php
echo $this->Markdown->transform($project->description);

echo $this->element('layout/loader_prism');

$this->end();

echo $this->element('layouts/defaultview');
