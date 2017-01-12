<?php
/*
 * File:
 *   src/Templates/Admin/Posts/view.ctp
 * Description:
 *   Administration - Displays a post
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', h($post->title));

// Language
$this->assign('contentLanguage', $post->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
$this->Html->addCrumb($this->Html->langLabel($post->title, $post->language->iso639_1, ['label' => false]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Author:') ?></strong> <?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($post->license) ?></li>
    <li><strong><?php echo __d('elabs', 'Created on:') ?></strong> <?php echo h($post->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($post->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Published on:') ?></strong> <?php echo h($post->publication_date) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($post->language->name, $post->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Safe:') ?></strong> <?php echo $this->ItemsAdmin->sfwLabel($post->sfw) ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->ItemsAdmin->statusLabel($post->status) ?></li>
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
    if ($post->status === STATUS_LOCKED):
        echo $this->Html->link($unlockIcon, ['action' => 'changeState', $post->id, 'unlock'], ['escape' => false, 'class' => 'btn btn-warning']);
    elseif ($post->status === STATUS_PUBLISHED):
        echo $this->Html->link($lockIcon, ['action' => 'changeState', $post->id, 'lock'], ['escape' => false, 'class' => 'btn btn-warning']);
    else:
        echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-warning disabled', 'escape' => false]);
    endif;
    // Close
    $class = 'btn btn-danger';
    $link = ['action' => 'changeState', $post->id, 'remove'];
    if ($post->status === STATUS_DELETED):
        $class .= ' disabled';
        $link = '#';
    endif;
    $linkIcon = $this->Html->iconT('times', __d('elabs', 'Disable'));
    echo $this->Form->postLink($linkIcon, $link, ['confirm' => __d('elabs', 'Are you sure you want to disable # {0}?', $post->id), 'escape' => false, 'class' => $class]);
    ?>
</div>
<?php
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon = $this->Html->iconT('list', __d('elabs', 'List of articles'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Posts', 'action' => 'index'], $linkOptions);
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
        <div class="tab-pane fade active in" id="tab-content"<?php echo $this->Html->langAttr($post->language->iso639_1) ?>>
            <?php
            echo $this->Html->displayMD($post->excerpt);
            echo $this->Html->displayMD($post->text);
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
