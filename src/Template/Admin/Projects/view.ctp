<?php
/*
 * File:
 *   src/Templates/Admin/Projects/view.ctp
 * Description:
 *   Administration - Displays a project
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', __d('projects', 'Admin/Project&gt; {0}', h($project->name)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('projects', 'Owner') ?></strong> <?php echo $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) ?></li>
    <li><strong><?php echo __d('projects', 'Url') ?></strong> <?php echo h($project->mainurl) ?></li>
    <li><strong><?php echo __d('licenses', 'License') ?></strong> <?php echo $this->License->d($project->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Creation date') ?></strong> <?php echo h($project->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Mod. date') ?></strong> <?php echo h($project->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($project->sfw); ?></li>
    <li><strong><?php echo __d('elabs', 'Status') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($project->status) ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
?>
<div class="btn-group btn-group-vertical btn-block">
    <?php
    // Lock/unlock
    $unlockIcon = __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('unlock-alt'), __d('admin', 'Unlock')]);
    $lockIcon = __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('lock'), __d('admin', 'Lock')]);
    if ($project->status === 2):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $project->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($project->status === 1):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $project->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $project->id, 'remove'];
    if ($project->status === 3):
        $class .= ' disabled';
        $link = '#';
    endif;
    echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('times'), 'Disable']), $link, ['confirm' => __d('disable', 'Are you sure you want to disable # {0}?', $project->id), 'escape' => false, 'class' => $class]);
    // List
    echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List files']), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']);
    ?>
</div>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <ul id="fileTabs" class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#tab-content" aria-expanded="true"><?php echo __d('users', 'Content') ?></a></li>
        <li><a data-toggle="tab" href="#tab-related" aria-expanded="false"><?php echo __d('users', 'Related items') ?></a></li>
    </ul>
    <div id = "userTabsContent" class = "tab-content">
        <div class="tab-pane fade active in" id="tab-content">
            <?php
            echo $this->Html->displayMD($project->short_description);
            echo $this->Html->displayMD($project->description);
            ?>
        </div>
        <div class="tab-pane" id="tab-related">
            <?php
            echo $this->element('layout/dev_block');
            ?>
        </div>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminview');
