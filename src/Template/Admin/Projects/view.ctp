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
$this->assign('title', h($project->name));

// Language
$this->assign('contentLanguage', $project->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Projects'), ['action' => 'index']);
$this->Html->addCrumb($this->Html->langLabel($project->name, $project->language->iso639_1, ['label' => false]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Owner:') ?></strong> <?php echo $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'Url:') ?></strong> <?php echo h($project->mainurl) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($project->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Creation date:') ?></strong> <?php echo h($project->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Mod. date:') ?></strong> <?php echo h($project->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($project->language->name, $project->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe:') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($project->sfw); ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($project->status) ?></li>
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
    $unlockIcon = __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('unlock-alt'), __d('elabs', 'Unlock')]);
    $lockIcon = __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('lock'), __d('elabs', 'Lock')]);
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
    echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('times'), 'Disable']), $link, ['confirm' => __d('elabs', 'Are you sure you want to disable # {0}?', $project->id), 'escape' => false, 'class' => $class]);
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
        <li class="active"><a data-toggle="tab" href="#tab-content" aria-expanded="true"><?php echo __d('elabs', 'Content') ?></a></li>
        <li><a data-toggle="tab" href="#tab-related" aria-expanded="false"><?php echo __d('elabs', 'Related items') ?></a></li>
    </ul>
    <div id = "userTabsContent" class = "tab-content">
        <div class="tab-pane fade active in" id="tab-content" lang="<?php echo $project->language->iso639_1 ?>">
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
