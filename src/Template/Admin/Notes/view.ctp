<?php
/*
 * File:
 *   src/Templates/Admin/Notes/view.ctp
 * Description:
 *   Administration - Displays a post
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'A note'));

// Language
$this->assign('contentLanguage', $note->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'A note'));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Author:') ?></strong> <?php echo $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($note->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Created on:') ?></strong> <?php echo h($note->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($note->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Published on:') ?></strong> <?php echo h($note->publication_date) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($note->language->name, $note->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe:') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($note->sfw) ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($note->status) ?></li>
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
    if ($note->status === STATUS_LOCKED):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $note->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($note->status === STATUS_PUBLISHED):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $note->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $note->id, 'remove'];
    if ($note->status === STATUS_DELETED):
        $class .= ' disabled';
        $link = '#';
    endif;
    $linkIcon = $this->Html->iconT('times', __d('elabs', 'Disable'));
    echo $this->Form->postLink($linkIcon, $link, ['confirm' => __d('elabs', 'Are you sure you want to disable # {0}?', $note->id), 'escape' => false, 'class' => $class]);
    ?>
</div>
<?php
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon = $this->Html->iconT('list', __d('elabs', 'List of articles'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'index'], $linkOptions);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <ul id="postTabs" class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#tab-content" aria-expanded="true"><?php echo __d('elabs', 'Content') ?></a></li>
        <li><a data-toggle="tab" href="#tab-related" aria-expanded="false"><?php echo __d('elabs', 'Related items') ?></a></li>
    </ul>
    <div id = "userTabsContent" class = "tab-content">
        <div class="tab-pane fade active in" id="tab-content" lang="<?php echo $note->language->iso639_1 ?>">
            <?php
            echo $this->Html->displayMD($note->text);
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
