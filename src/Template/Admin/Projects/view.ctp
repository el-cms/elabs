<?php
$this->assign('title', h($project->name));

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __('Id') ?></dt>
    <dd><?php echo $this->Number->format($project->id) ?></dd>
    <dt><?php echo __d('projects', 'Owner') ?></dt>
    <dd><?php echo $this->Html->link($project->user->username, ['controller' => 'Users', 'action' => 'view', $project->user->id]) ?></dd>
    <dt><?php echo __d('projects', 'Url') ?></dt>
    <dd><?php echo h($project->mainurl) ?></dd>
    <dt><?php echo __d('licenses', 'License') ?></dt>
    <dd><?php echo $this->License->d($project->license) ?></dd>
    <dt><?php echo __d('elabs', 'Creation date') ?></dt>
    <dd><?php echo h($project->created) ?></dd>
    <dt><?php echo __d('elabs', 'Mod. date') ?></dt>
    <dd><?php echo h($project->modified) ?></dd>
    <dt><?php echo __d('elabs', 'Safe') ?></dt>
    <dd><?php echo $this->ItemsAdmin->sfwLabel($project->sfw); ?></dd>
    <dt><?php echo __d('elabs', 'Status') ?></dt>
    <dd><?php echo $this->ItemsAdmin->statusLabel($project->status) ?></dd>
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
        if ($project->status === 2):
            echo $this->Html->link($unlockIcon, ['action' => 'changeState', $project->id, 'unlock'], $linkConfig);
        elseif ($project->status === 1):
            echo $this->Html->link($lockIcon, ['action' => 'changeState', $project->id, 'lock'], $linkConfig);
        else:
            echo $this->Html->link($lockIcon, '#', ['class' => 'btn btn-flat disabled', 'escape' => false]);
        endif;
        ?>
    </li>
    <li>
        <?php
        $class = 'btn btn-flat waves-attach waves-effect waves-effect';
        $link = ['action' => 'changeState', $project->id, 'remove'];
        if ($project->status === 3):
            $class = 'btn btn-flat disabled';
            $link = '#';
        endif;
        echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-times"></span>', 'Disable']), $link, ['confirm' => __('Are you sure you want to disable # {0}?', $project->id), 'escape' => false, 'class' => $class])
        ?>
    </li>
    <li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List projects']), ['action' => 'index'], $linkConfig) ?> </li>
</ul>
<?php
$this->end();

$this->start('pageContent');
echo $this->Markdown->transform($project->short_description);
?>
<hr/>
<?php
echo $this->Markdown->transform($project->description);
$this->end();

echo $this->element('layouts/defaultview');
