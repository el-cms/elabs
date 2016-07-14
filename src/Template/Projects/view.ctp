<?php
/*
 * File:
 *   src/Templates/Projects/view.ctp
 * Description:
 *   Display of a single project
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('projects', 'Project: {0}', h($project->name)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $project->license->icon . '"></span>', $project->license->name]), ['controller' => 'Licenses', 'action' => 'view', $project->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('elabs', 'Created on') ?></strong> <?php echo h($project->created) ?></li>
    <?php if ($project->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Modified on') ?></strong> <?php echo h($project->modified) ?></li>
    <?php endif; ?>
    <li><strong><?php echo __d('elabs', 'Safe content:') ?></strong> <span class="label label-<?php echo $project->sfw ? 'success' : 'danger'; ?>"><?php echo $project->sfw ? __('Yes') : __('No'); ?></span></li>
    <li><strong><?php echo __d('elabs', 'Tags:') ?></strong> <?php echo $this->element('layout/dev_inline') ?></li>
</ul>

<h5 class="list-group-item-heading"><?php echo __d('elabs', 'Members') ?></h5>
<ul class="list-unstyled">
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

// Block: Actions
// --------------
if ($project->has('mainurl')):
    $this->start('pageActions');
    echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-external-link"></span>', __d('elabs', 'Website')]), $project->mainurl, ['escape' => false, 'class' => 'btn btn-block']);
    $this->end();
endif;

// Block: Page content
// -------------------
$this->start('pageContent');
echo $this->Html->displayMD($project->short_description);
echo $this->Html->displayMD($project->description);
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
