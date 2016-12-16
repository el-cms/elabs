<?php
/*
 * File:
 *   src/Templates/Admin/Albums/view.ctp
 * Description:
 *   Administration - Displays an album
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', $album->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
$this->Html->addCrumb($album->name);

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Owner:') ?></strong> <?php echo $this->Html->link($album->user->username, ['controller' => 'Users', 'action' => 'view', $album->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'Name:') ?></strong> <small><?php echo h($album->name) ?></small></li>
    <li><strong><?php echo __d('elabs', 'Created on:') ?></strong> <?php echo h($album->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($album->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($album->language->name, $album->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe:') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($album->sfw); ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($album->status) ?></li>
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
    if ($album->status === STATUS_LOCKED):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $album->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($album->status === STATUS_PUBLISHED):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $album->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $album->id, 'remove'];
    if ($album->status === STATUS_DELETED):
        $class .= ' disabled';
        $link = '#';
    endif;
    $linkIcon = $this->Html->iconT('times', __d('elabs', 'Disable'));
    echo $this->Form->postLink($linkIcon, $link, ['confirm' => __d('elabs', 'Are you sure you want to disable # {0}?', $album->id), 'escape' => false, 'class' => $class]);
    ?>
</div>
<?php
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon = $this->Html->iconT('list', __d('elabs', 'List of albums'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Albums', 'action' => 'index'], $linkOptions);
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
        <div class="tab-pane fade active in" id="tab-content"<?php echo $this->Html->langAttr($album->language->iso639_1) ?>>
            <?php
            echo $this->Html->displayMD($album->description);
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
