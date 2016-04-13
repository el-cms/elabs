<?php
$this->assign('title', __d('files', 'Admin/File&gt; {0}', h($file->name)));

$this->loadHelper('Items');
$config = $this->Items->fileConfig($file['filename']);

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __d('files', 'Owner') ?></dt>
    <dd><?php echo $this->Html->link($file->user->username, ['controller' => 'Users', 'action' => 'view', $file->user->id]) ?></dd>
    <dt><?php echo __d('files', 'Name') ?></dt>
    <dd><small><?php echo h($file->name) ?></small></dd>
    <dt><?php echo __d('files', 'File name') ?></dt>
    <dd><small><?php echo h($file->filename) ?></small></dd>
    <dt><?php echo __d('files', 'File size') ?></dt>
    <dd><?php echo $file->weight ?></dd>
    <dt><?php echo __d('licenses', 'License') ?></dt>
    <dd><?php echo $this->License->d($file->license) ?></dd>
    <dt><?php echo __d('elabs', 'Creation date') ?></dt>
    <dd><?php echo h($file->created) ?></dd>
    <dt><?php echo __d('elabs', 'Mod. date') ?></dt>
    <dd><?php echo h($file->modified) ?></dd>
    <dt><?php echo __d('elabs', 'Safe') ?></dt>
    <dd><?php echo $this->ItemsAdmin->sfwLabel($file->sfw); ?></dd>
    <dt><?php echo __d('elabs', 'Status') ?></dt>
    <dd><?php echo $this->ItemsAdmin->statusLabel($file->status) ?></dd>
</dl>
<?php
$this->end();

$this->start('pageActions');
$linkConfig = ['escape' => false, 'class' => 'btn btn-flat waves-attach waves-effect waves-effect'];
?>
<ul>
    <li>
        <?php
        $unlockIcon = __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-unlock-alt fa-fw"></span>', __d('admin', 'Unlock')]);
        $lockIcon = __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-lock fa-fw"></span>', __d('admin', 'Lock')]);
        if ($file->status === 2):
            echo $this->Html->link($unlockIcon, ['action' => 'changeState', $file->id, 'unlock'], $linkConfig);
        elseif ($file->status === 1):
            echo $this->Html->link($lockIcon, ['action' => 'changeState', $file->id, 'lock'], $linkConfig);
        else:
            echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-flat disabled', 'escape' => false]);
        endif;
        ?>
    </li>
    <li>
        <?php
        $class = 'btn btn-flat waves-attach waves-effect waves-effect';
        $link = ['action' => 'changeState', $file->id, 'remove'];
        if ($file->status === 3):
            $class = 'btn btn-flat disabled';
            $link = '#';
        endif;
        echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-times"></span>', 'Disable']), $link, ['confirm' => __d('disable','Are you sure you want to disable # {0}?', $file->id), 'escape' => false, 'class' => $class])
        ?>
    </li>
    <li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List files']), ['action' => 'index'], $linkConfig) ?> </li>
</ul>
<?php
$this->end();

$this->start('pageContent');
echo $this->Elabs->displayMD($file->description);
?>
<hr />
<?php
echo $this->element('files/view_content_' . $config['element'], ['data' => $file]);
?>
<div class="content-sub-heading"><?php echo __d('elabs', 'Related items') ?></div>
<?php
echo $this->element('layout/dev_block');

$this->end();

echo $this->element('layouts/defaultview');
