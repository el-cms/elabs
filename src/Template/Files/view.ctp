<?php
$this->assign('title', __d('file', 'File: {0}', h($file->name)));

$this->start('pageInfos');

$this->loadHelper('Items');
$config = $this->Items->fileConfig($file['filename']);
?>
<dl class="dl-horizontal">
    <dt><?php echo __d('files', 'Name') ?></dt>
    <dd><?php echo h($file->name) ?></dd>
    <dt><?php echo __d('elabs', 'License') ?></dt>
    <dd><?php echo $this->License->d($file->license, true) ?></dd>
    <dt><?php echo __d('files', 'Creator') ?></dt>
    <dd><?php echo $file->has('user') ? $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) : '' ?></dd>
    <dt><?php echo __d('files', 'File size') ?></dt>
    <dd><?php echo $file->weight ?></dd>
    <dt><?php echo __d('elabs', 'Added on') ?></dt>
    <dd><?php echo h($file->created) ?></dd>
    <?php if ($file->has('modified')): ?>
        <dt><?php echo __d('elabs', 'Modified on') ?></dt>
        <dd><?php echo h($file->modified) ?></dd>
    <?php endif; ?>
    <dt><?php echo __d('elabs', 'Safe content') ?></dt>
    <dd><span class="label label-<?php echo $file->sfw ? 'green' : 'red'; ?>"><?php echo $file->sfw ? __('Yes') : __('No'); ?></span></dd>
    <dt><?php echo __d('elabs', 'Tags') ?></dt>
    <dd><?php echo $this->element('layout/dev_inline') ?></dd>
</dl>
<?php
$this->end();

$this->start('pageActions');
echo $this->html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-download"></span>', __d('files', 'Download')]), ['action' => 'download', $file->id], ['escape' => false, 'class' => 'btn btn-block btn-green']);
$this->end();

$this->start('pageContent');

echo $this->Html->displayMD($file->description);
echo $this->element('files/view_content_' . $config['element'], ['data' => $file]);
echo $this->element('layout/loader_prism');

$this->end();

echo $this->element('layouts/defaultview');
