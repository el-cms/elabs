<?php
/*
 * File:
 *   src/Templates/Files/view.ctp
 * Description:
 *   Display of a single file record
 * Layout element:
 *   defaultview.ctp
 */

// Custom helpers
$this->loadHelper('Items');

// Page title
$this->assign('title', __d('file', 'File: {0}', h($file->name)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
$config = $this->Items->fileConfig($file['filename']);
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('files', 'Name: ') ?></strong> <?php echo h($file->name) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->License->d($file->license, true) ?></li>
    <li><strong><?php echo __d('files', 'Creator:') ?></strong> <?php echo $file->has('user') ? $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></li>
    <li><strong><?php echo __d('files', 'File size:') ?></strong> <?php echo $file->weight ?></li>
    <li><strong><?php echo __d('files', 'Mime type:') ?></strong> <?php echo $file->mime ?></li>
    <li><strong><?php echo __d('elabs', 'Added on:') ?></strong> <?php echo h($file->created) ?></li>
    <?php if ($file->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Modified on:') ?></strong> <?php echo h($file->modified) ?></li>
    <?php endif; ?>
    <li><strong><?php echo __d('elabs', 'Safe content:') ?></strong> <span class="label label-<?php echo $file->sfw ? 'success' : 'danger'; ?>"><?php echo $file->sfw ? __('Yes') : __('No'); ?></span></li>
    <li><strong><?php echo __d('elabs', 'Tags:') ?></strong> <?php echo $this->element('layout/dev_inline') ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
echo $this->html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('download'), __d('files', 'Download')]), ['action' => 'download', $file->id], ['escape' => false, 'class' => 'btn btn-block']);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
echo $this->Html->displayMD($file->description) ?>
<div class="panel">
    <div class="panel-body">
    <?php echo $this->element('files/view_content_' . $config['element'], ['data' => $file]) ?>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
