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
$this->assign('title', __d('elabs', 'Admin/User&gt; {0}', h($user->realname)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Username') ?></strong> <?php echo h($user->username) ?></li>
    <li><strong><?php echo __d('elabs', 'Name') ?></strong> <?php echo h($user->realname) ?></li>
    <li><strong><?php echo __d('elabs', 'Website') ?></strong> <?php echo h($user->website) ?></li>
    <li><strong><?php echo __d('elabs', 'Member since') ?></strong> <?php echo h($user->created) ?></li>
    <li><strong><?php echo __d('elabs', 'Last modification') ?></strong> <?php echo h($user->modified) ?></li>
    <li><strong><?php echo __d('elabs', 'Status') ?></strong> <?php echo $this->UsersAdmin->statusLabel($user->status) ?></li>
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
          echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', [$this->Html->icon('check'), __d('elabs', 'Activate')]), ['action' => 'activate', $user->id], ['class' => 'btn btn-warning', 'escape' => false]);
      endif;
      $unlockIcon = $this->Html->icon('unlock', ['title' => __d('elabs', 'Unlock')]);
      $lockIcon = $this->Html->icon('lock', ['title' => __d('elabs', 'Lock')]);
      if ($user->status === 2):
          echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$unlockIcon, __d('elabs', 'Unlock')]), ['action' => 'lock', $user->id, 'unlock'], ['class' => 'btn btn-warning', 'escape' => false]);
      elseif ($user->status === 1):
          echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$lockIcon, __d('elabs', 'Lock')]), ['action' => 'lock', $user->id, 'lock'], ['class' => 'btn btn-warning', 'escape' => false]);
      else:
          echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('lock'), 'Lock/unlock']), '#', ['class' => 'text-sec btn-warning disabled', 'escape' => false]);
      endif;
      ?>
      <?php
      if ($user->status != 3):
          echo $this->Html->link(__d('elabs', '{0}&nbsp{1}', [$this->Html->icon('times'), __d('elabs', 'Close')]), ['action' => 'close', $user->id], ['confirm' => __d('elabs', 'Are you sure you want to close this account ?'), 'class' => 'btn btn-danger', 'escape' => false]);
      endif;
      // List
      echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List users']), ['action' => 'index'], ['class' => 'btn btn-primary', 'escape' => false]);
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
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles ({0})', $user->post_count) ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects ({0})', $user->project_count) ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files ({0})', $user->file_count) ?></a></li>
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
