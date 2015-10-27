<?php
$this->assign('title', h($project->name));

$this->start('pageInfos');
?>
<dl>
  <dt><?= __('Download link') ?></dt>
  <dd><?= h($project->download) ?></dd>
  <dt><?= __('License') ?></dt>
  <dd><?= $project->has('license') ? $this->Html->link($project->license->name, ['controller' => 'Licenses', 'action' => 'view', $project->license->id]) : '' ?></dd>
  <dt><?= __('Created on') ?></dt>
  <dd><?= h($project->created) ?></tr>
  <dt><?= __('Modified on') ?></dt>
  <dd><?= h($project->modified) ?></tr>
  <dt><?= __('Safe content') ?></dt>
  <dd class="label label-<?php echo $project->sfw ? 'green' : 'red'; ?>"><?= $project->sfw ? __('Yes') : __('No'); ?></dd>
</dl>

<div class="content-sub-heading"><?= __('Members') ?></div>
<ul>
  <li><?= $project->has('user') ? $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></li>
  <?php if (!empty($project->project_users)): ?>

      <?php foreach ($project->project_users as $projectUsers): ?>
          <li><?= $this->Html->link(h($projectUsers->id), ['controller' => 'ProjectUsers', 'action' => 'view', $projectUsers->id]) ?></li>  
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
