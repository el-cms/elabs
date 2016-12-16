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
$this->assign('title', $file->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb($file->name);

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Owner:') ?></strong> <?php echo $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'Name:') ?></strong> <small><?php echo h($file->name) ?></small></li>
    <li><strong><?php echo __d('elabs', 'File name:') ?></strong> <small><?php echo h($file->filename) ?></small></li>
    <li><strong><?php echo __d('elabs', 'File size:') ?></strong> <?php echo $file->weight ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($file->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Created on:') ?></strong> <?php echo h($file->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($file->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($file->language->name, $file->language->iso639_1) ?></li>
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
    $unlockIcon = $this->Html->iconT('unlock-alt', __d('elabs', 'Unlock'));
    $lockIcon = $this->Html->iconT('lock', __d('elabs', 'Lock'));
    if ($file->status === STATUS_LOCKED):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $file->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($file->status === STATUS_PUBLISHED):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $file->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $file->id, 'remove'];
    if ($file->status === STATUS_DELETED):
        $class .= ' disabled';
        $link = '#';
    endif;
    $linkIcon = $this->Html->iconT('times', __d('elabs', 'Disable'));
    echo $this->Form->postLink($linkIcon, $link, ['confirm' => __d('elabs', 'Are you sure you want to disable # {0}?', $file->id), 'escape' => false, 'class' => $class]);
    ?>
</div>
<?php
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon = $this->Html->iconT('list', __d('elabs', 'List of files'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Files', 'action' => 'index'], $linkOptions);
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
        <div class="tab-pane fade active in" id="tab-content"<?php echo $this->Html->langAttr($file->language->iso639_1) ?>>
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
