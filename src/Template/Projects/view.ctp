<?php
$this->assign('title', h($project->name));

$this->start('pageInfos');
?>
<dl>
  <dt><?php echo __d('elabs', 'Url') ?></dt>
  <dd><?php echo h($project->download) ?></dd>
  <dt><?php echo __d('elabs', 'License') ?></dt>
  <dd><?php echo $project->has('license') ? $this->Html->link($project->license->name, ['controller' => 'Licenses', 'action' => 'view', $project->license->id]) : '' ?></dd>
  <dt><?php echo __d('elabs', 'Created on') ?></dt>
  <dd><?php echo h($project->created) ?></tr>
  <dt><?php echo __d('elabs', 'Modified on') ?></dt>
  <dd><?php echo h($project->modified) ?></tr>
  <dt><?php echo __d('elabs', 'Safe content') ?></dt>
  <dd class="label label-<?php echo $project->sfw ? 'green' : 'red'; ?>"><?php echo $project->sfw ? __('Yes') : __('No'); ?></dd>
  <dt><?php echo __d('elabs', 'Tags') ?></dt>
  <dd><?php echo $this->element('layout/dev_inline') ?></dd>
</dl>

<div class="content-sub-heading"><?php echo __d('elabs', 'Members') ?></div>
<ul>
  <li><?php echo $project->has('user') ? $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></li>
  <?php if (!empty($project->project_users)): ?>

      <?php foreach ($project->project_users as $projectUsers): ?>
          <li><?php echo $this->Html->link(h($projectUsers->id), ['controller' => 'ProjectUsers', 'action' => 'view', $projectUsers->id]) ?></li>  
      <?php endforeach; ?>

  <?php endif; ?>
  <li><?php echo $this->element('layout/dev_inline') ?></li>
</ul>
<?php
$this->end();

$this->start('pageContent');

echo $this->Markdown->transform($project->short_description);
?>
<hr />
<?php
echo $this->Markdown->transform($project->description);

echo $this->element('layout/loader_prism');

$this->end();

echo $this->element('layouts/defaultview');
