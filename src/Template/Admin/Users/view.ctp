<?php
/*
 * File:
 *   src/Templates/Admin/Users/view.ctp
 * Description:
 *   Administration - Displays an user
 * Layout element:
 *   adminview.ctp
 */

// Page title
$this->assign('title', h($user->realname));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Users'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Username:') ?></strong> <?php echo h($user->username) ?></li>
    <li><strong><?php echo __d('elabs', 'Name:') ?></strong> <?php echo h($user->realname) ?></li>
    <li><strong><?php echo __d('elabs', 'Website:') ?></strong> <?php echo h($user->website) ?></li>
    <li><strong><?php echo __d('elabs', 'Member since:') ?></strong> <?php echo h($user->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Last update:') ?></strong> <?php echo h($user->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Status:') ?></strong> <?php echo $this->UsersAdmin->statusLabel($user->status) ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
?>
<div class="btn-group btn-group-vertical btn-block">
    <?php
    if ($user->status != 3):
        if ($user->status === 0):
            echo $this->Html->link($this->Html->iconT('check', _d('elabs', 'Activate')), ['action' => 'activate', $user->id], ['class' => 'btn btn-warning', 'escape' => false]);
        endif;
        if ($user->status === 2):
            echo $this->Html->link($this->Html->iconT('unlock', __d('elabs', 'Unlock')), ['action' => 'lock', $user->id, 'unlock'], ['class' => 'btn btn-warning', 'escape' => false]);
        elseif ($user->status === 1):
            echo $this->Html->link($this->Html->iconT('lock', __d('elabs', 'Lock')), ['action' => 'lock', $user->id, 'lock'], ['class' => 'btn btn-warning', 'escape' => false]);
        else:
            echo $this->Html->link($this->Html->iconT('lock', __d('elabs', 'Lock/unlock')), '#', ['class' => 'text-sec btn-warning disabled', 'escape' => false]);
        endif;
        if ($user->status != 3):
            echo $this->Html->link($this->Html->iconT('times', __d('elabs', 'Close')), ['action' => 'close', $user->id], ['confirm' => __d('elabs', 'Are you sure you want to close this account ?'), 'class' => 'btn btn-danger', 'escape' => false]);
        endif;
    else:
        ?>
        <p class="muted">
            <?php echo __d('elabs', 'This account has been closed, so no further actions are available.'); ?>
        </p>
    <?php
    endif;
    ?></div>
<?php
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon=$this->Html->iconT('list', __d('elabs', 'List of users'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index'], $linkOptions);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
if ($user->has('bio')):
    ?>
    <div class="well">
        <?php echo $this->Html->displayMD($user->bio) ?>
    </div>
    <?php
endif;
?>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles {0}', '<span class="badge">' . $user->post_count . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects {0}', '<span class="badge">' . $user->project_count . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files {0}', '<span class="badge">' . $user->file_count . '</span>') ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($user->posts)):
                foreach ($user->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($user->projects)):
                foreach ($user->projects as $projects):
                    echo $this->element('projects/card', ['data' => $projects, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($user->files)):
                foreach ($user->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'userInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminview');
