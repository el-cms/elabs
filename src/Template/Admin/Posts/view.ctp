<?php
$this->assign('title', h($post->title));

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __('Id') ?></dt>
    <dd><?php echo $this->Number->format($post->id) ?></dd>
    <dt><?php echo __d('elabs', 'Author') ?></dt>
    <dd><?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></dd>
    <dt><?php echo __('License') ?></dt>
    <dd><?php echo $this->License->d($post->license) ?></dd>
    <dt><?php echo __('Created') ?></dt>
    <dd><?php echo h($post->created) ?></tr>
    <dt><?php echo __('Modified') ?></dt>
    <dd><?php echo h($post->modified) ?></tr>
    <dt><?php echo __('Publication Date') ?></dt>
    <dd><?php echo h($post->publication_date) ?></tr>
    <dt><?php echo __('Sfw') ?></dt>
    <dd><?php echo $this->ItemsAdmin->sfwLabel($post->sfw) ?></dd>
    <dt><?php echo __('Status') ?></dt>
    <dd><?php echo $this->ItemsAdmin->statusLabel($post->status) ?></dd>
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
        if ($post->status === 2):
            echo $this->Html->link($unlockIcon, ['action' => 'changeState', $post->id, 'unlock'], $linkConfig);
        elseif ($post->status === 1):
            echo $this->Html->link($lockIcon, ['action' => 'changeState', $post->id, 'lock'], $linkConfig);
        else:
            echo $this->Html->link($lockIcon, '#',['class'=>'btn btn-flat disabled', 'escape'=>false]);
        endif;
        ?>
    </li>
    <li>
        <?php
        $class = 'btn btn-flat waves-attach waves-effect waves-effect';
        $link = ['action' => 'changeState', $post->id, 'remove'];
        if ($post->status === 3):
            $class = 'btn btn-flat disabled';
            $link = '#';
        endif;
        echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-times"></span>', 'Disable']), $link, ['confirm' => __('Are you sure you want to disable # {0}?', $post->id), 'escape' => false, 'class' => $class])
        ?>
    </li>
    <li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List posts']), ['action' => 'index'], $linkConfig) ?> </li>
</ul>
<?php
$this->end();

$this->start('pageContent');
echo $this->Markdown->transform($post->excerpt)
?>
<hr/>
<?php echo $this->Markdown->transform($post->text); ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
