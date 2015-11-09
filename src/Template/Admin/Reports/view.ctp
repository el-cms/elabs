<?php
$this->assign('title', h($report->name));

$this->start('pageInfos');
?>
<dl>
    <dt><?php echo __('Id') ?></dt>
    <dd><?php echo $report->id ?></dd>
    <dt><?php echo __('Url') ?></dt>
    <dd><?php echo $this->Html->link(h($report->url), h($report->url)) ?></dd>
    <dt><?php echo __('Created') ?></dt>
    <dd><?php echo h($report->created) ?></dd>
    <dt><?php echo __('Author') ?></dt>
    <dd>
        <?php
        if ($report->has(['user'])):
            $icon = 'check-circle';
            $uname = $this->Html->link($report->user->username, ['controller' => 'Users', 'action' => 'view', $report->user->id]);
        else:
            $icon = 'circle-o';
            $uname = $report['name'];
        endif;
        $icon = '<span class="fa fa-fw fa-' . $icon . '"></span>';

        echo __d('elabs', '{0}&nbsp;{1}', [$icon, $uname]);
        ?>
    </dd>
    <dt><?php echo __('Email') ?></dt>
    <dd><?php echo h($report->email) ?></dd>
</dl>
<?php
$this->end();

$this->start('pageActions');
$class = 'btn btn-flat waves-attach waves-effect waves-effect';
?>
<ul>
    <li><?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-trash-o"></span>', 'Delete']), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'escape' => false, 'class' => $class]) ?> </li>
    <li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Reports list']), ['action' => 'index'], ['escape' => false, 'class' => $class]) ?> </li>
</ul>
<?php
$this->end();

$this->start('pageContent');
?>
<div class="content-sub-heading"><?php echo __d('reports', 'Reason') ?></div>
<?php
echo h($report->reason);
?>
<div class="content-sub-heading"><?php echo __d('reports', 'Session') ?></div>
<pre>
    <?php
    echo h($report->session);
    ?>
</pre>
<?php
echo $this->element('layout/dev_block');
$this->end();

echo $this->element('layouts/defaultview');
