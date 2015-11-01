<?php
$this->assign('title', h($user->realname));

$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __('Username') ?></dt>
    <dd><?php echo h($user->username) ?></dd>
    <dt><?php echo __('Name') ?></dt>
    <dd><?php echo h($user->realname) ?></dd>
    <dt><?php echo __('Website') ?></dt>
    <dd><?php echo h($user->website) ?></dd>
    <dt><?php echo __('Member since') ?></dt>
    <dd><?php echo h($user->created) ?></dd>
    <dt><?php echo __('Last modification') ?></dt>
    <dd><?php echo h($user->modified) ?></dd>
    <dt><?php echo __('Status') ?></dt>
    <dd><?php echo $this->UserAdmin->statusLabel($user->status) ?></dd>
</dl>
<?php
if ($user->status != 3):
    ?>
    <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
    <ul class="margin-no nav nav-list">
        <li id="btnLock<?php echo $user->id ?>">
            <?php
            $unlockIcon = '<span class="fa fa-unlock-alt fa-fw" title="' . __d('admin', 'Unlock') . '"></span>';
            $lockIcon = '<span class="fa fa-lock fa-fw" title="' . __d('admin', 'Lock') . '"></span>';
            if ($user->status === 2):
                echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', [$unlockIcon, __d('admin', 'Unlock')]), ['action' => 'lock', $user->id, 'unlock'], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false,]);
            elseif ($user->status === 1):
                echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', [$lockIcon, __d('admin', 'Lock')]), ['action' => 'lock', $user->id, 'lock'], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false,]);
            else:
                echo '<a class="text-sec"><span class="fa fa-fw"></span></a>';
            endif;
            ?>
        </li>
        <li id="btnClose<?php echo $user->id ?>">
            <?php
            if ($user->status != 3):
                echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', ['<span class="fa fa-times"></span>', __d('admin', 'Close')]), ['action' => 'close', $user->id], ['class' => 'text-sec waves-attach waves-effect', 'escape' => false]);
            endif;
            ?>
        </li>
    </ul>

    <?php
else:
    ?>
    <p class="muted">
        <?php echo __d('users', 'This account has been closed, so no further actions are available.'); ?>
    </p>
<?php
endif;
$this->end();

$this->start('pageContent');

echo h($user->bio);
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
    if (!empty($user->posts)):
        foreach ($user->posts as $posts):
            echo $this->element('posts/card_belongtouser', ['data' => $posts]);
        endforeach;
    endif;
    ?>
</div>

<div class="tab-pane" id="projects-tab">
    <?php
    if (!empty($user->projects)):
        foreach ($user->projects as $projects):
            echo $this->element('projects/card_belongtouser', ['data' => $projects]);
        endforeach;
    endif;
    ?>
</div>

<div class="tab-pane" id="files-tab">

</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
