<?php
$this->assign('title', __d('users', 'Admin/User&gt; {0}', h($user->realname)));

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __d('users', 'Username') ?></dt>
    <dd><?php echo h($user->username) ?></dd>
    <dt><?php echo __d('users', 'Name') ?></dt>
    <dd><?php echo h($user->realname) ?></dd>
    <dt><?php echo __d('users', 'Website') ?></dt>
    <dd><?php echo h($user->website) ?></dd>
    <dt><?php echo __d('users', 'Member since') ?></dt>
    <dd><?php echo h($user->created) ?></dd>
    <dt><?php echo __d('users', 'Last modification') ?></dt>
    <dd><?php echo h($user->modified) ?></dd>
    <dt><?php echo __d('elabs', 'Status') ?></dt>
    <dd><?php echo $this->UsersAdmin->statusLabel($user->status) ?></dd>
</dl>
<?php
if ($user->status != 3):
    $this->start('pageActions');
    $linkOptions = ['class' => 'btn btn-flat waves-attach waves-effect', 'escape' => false];
    ?>
    <ul>
        <li>
            <?php
            if ($user->status === 0):
                echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', ['<span class="fa fa-check"></span>', __d('admin', 'Activate')]), ['action' => 'activate', $user->id], $linkOptions);
            endif;
            ?>
        </li>
        <li>
            <?php
            $unlockIcon = '<span class="fa fa-unlock-alt fa-fw" title="' . __d('admin', 'Unlock') . '"></span>';
            $lockIcon = '<span class="fa fa-lock fa-fw" title="' . __d('admin', 'Lock') . '"></span>';
            if ($user->status === 2):
                echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$unlockIcon, __d('admin', 'Unlock')]), ['action' => 'lock', $user->id, 'unlock'], $linkOptions);
            elseif ($user->status === 1):
                echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$lockIcon, __d('admin', 'Lock')]), ['action' => 'lock', $user->id, 'lock'], $linkOptions);
            else:
                echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-lock"></span>', 'Lock/unlock']), '#', ['class' => 'text-sec btn btn-flat disabled', 'escape' => false]);
            endif;
            ?>
        </li>
        <li>
            <?php
            if ($user->status != 3):
                echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', ['<span class="fa fa-times"></span>', __d('admin', 'Close')]), ['action' => 'close', $user->id], $linkOptions);
            endif;
            ?>
        </li>
        <li>
        <li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List users']), ['action' => 'index'], $linkOptions) ?> </li>
    </li>
    </ul>

    <?php
    $this->end();
else:
    ?>
    <p class="muted">
        <?php echo __d('users', 'This account has been closed, so no further actions are available.'); ?>
    </p>
<?php
endif;
$this->end();

$this->start('pageContent');

echo $this->Markdown->transform(h($user->bio));
?>

<nav class="tab-nav tab-nav-brand">
    <ul class="nav nav-justified">
        <li class="active">
            <a class="waves-attach waves-effect" data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Articles') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Projects') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Files') ?></a>
        </li>
    </ul>
    <div class="tab-nav-indicator"></div>
</nav>

<div class="tab-pane fade active in" id="posts-tab">
    <?php
    if ($user->posts):
        foreach ($user->posts as $posts):
            echo $this->element('posts/card', ['data' => $posts]);
        endforeach;
    else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>

<div class="tab-pane" id="projects-tab">
    <?php
    if ($user->projects):
        foreach ($user->projects as $projects):
            echo $this->element('projects/card', ['data' => $projects]);
        endforeach;
    else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>

<div class="tab-pane" id="files-tab">
    <?php
    if ($user->files):
        foreach ($user->files as $files):
            echo $this->element('files/card', ['data' => $files]);
        endforeach;
    else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
