<?php
/*
 * File:
 *   src/Templates/Admin/Files/view.ctp
 * Description:
 *   Administration - Displays a file
 * Layout element:
 *   adminview.ctp
 */

// Additionnal helpers
$this->loadHelper('Items');
$config = $this->Items->fileConfig($file['filename']);

// Page title
$this->assign('title', __d('files', 'Admin/File&gt; {0}', h($file->name)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('files', 'Owner:') ?></strong> <?php echo $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) ?></li>
    <li><strong><?php echo __d('files', 'Name:') ?></strong> <small><?php echo h($file->name) ?></small></li>
    <li><strong><?php echo __d('files', 'File name:') ?></strong> <small><?php echo h($file->filename) ?></small></li>
    <li><strong><?php echo __d('files', 'File size:') ?></strong> <?php echo $file->weight ?></li>
    <li><strong><?php echo __d('licenses', 'License:') ?></strong> <?php echo $this->License->d($file->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Creation date:') ?></strong> <?php echo h($file->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Mod. date:') ?></strong> <?php echo h($file->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe:') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($file->sfw); ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($file->status) ?></li>
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
    if ($file->status === 2):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $file->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($file->status === 1):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $file->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $file->id, 'remove'];
    if ($file->status === 3):
        $class .= ' disabled';
        $link = '#';
    endif;
    echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('times'), 'Disable']), $link, ['confirm' => __d('disable', 'Are you sure you want to disable # {0}?', $file->id), 'escape' => false, 'class' => $class]);
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
            echo $this->Html->displayMD($file->description);
            echo $this->element('files/view_content_' . $config['element'], ['data' => $file]);
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
