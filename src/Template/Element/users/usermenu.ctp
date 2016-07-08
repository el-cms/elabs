<?php
$linkConfig = ['escape' => false];
?>
<li>
    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-pencil fa-lg fa-fw"></span>', __d('users', 'Update profile')]), ['prefix' => 'user', 'controller' => 'users', 'action' => 'edit'], $linkConfig) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-sign-out fa-lg fa-fw"></span>', __d('users', 'Logout')]), ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], $linkConfig) ?>
</li>
<li class="title">
    <?php echo __d('posts', 'Articles:') ?>
</li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-list"></span>&nbsp;', __d('elabs', 'Manage')]), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-plus"></span>&nbsp;', __d('posts', 'Write something !')]), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'add'], $linkConfig) ?></li>
<li class="title">
    <?php echo __d('projects', 'Projects:') ?>
</li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-list"></span>&nbsp;', __d('elabs', 'Manage')]), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-plus"></span>&nbsp;', __d('projects', 'Add a project !')]), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'add'], $linkConfig) ?></li>
<li class="title">
    <?php echo __d('files', 'Files:') ?>
</li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-list"></span>&nbsp;', __d('elabs', 'Manage')]), ['prefix' => 'user', 'controller' => 'files', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-plus"></span>&nbsp;', __d('files', 'Upload some files !')]), ['prefix' => 'user', 'controller' => 'files', 'action' => 'add'], $linkConfig) ?></li>