<?php
$linkConfig = ['escape' => false];
?>
<li>
    <?php echo $this->Html->link($this->Html->iconT('dashboard', __d('elabs', 'dashboard')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'dashboard', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
    <?php echo $this->Html->link($this->Html->iconT('pencil', __d('elabs', 'Update profile')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'users', 'action' => 'edit'], $linkConfig) ?>
</li>
<li>
    <?php echo $this->Html->link($this->Html->iconT('sign-out', __d('elabs', 'Logout')), ['plugin' => null, 'prefix' => false, 'controller' => 'users', 'action' => 'logout'], $linkConfig) ?>
</li>
<li class="dropdown-header">
    <?php echo __d('elabs', 'Articles:') ?>
</li>
<li><?php echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Manage')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'posts', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Write something !')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'posts', 'action' => 'add'], $linkConfig) ?></li>
<li class="dropdown-header">
    <?php echo __d('elabs', 'Notes:') ?>
</li>
<li><?php echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Manage')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'notes', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Write something !')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'notes', 'action' => 'add'], $linkConfig) ?></li>
<li class="dropdown-header">
    <?php echo __d('elabs', 'Projects:') ?>
</li>
<li><?php echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Manage')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'projects', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Add a project !')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'projects', 'action' => 'add'], $linkConfig) ?></li>
<li class="dropdown-header">
    <?php echo __d('elabs', 'Files:') ?>
</li>
<li><?php echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Manage')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'files', 'action' => 'index'], $linkConfig) ?></li>
<li><?php echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Upload some files !')), ['plugin' => null, 'prefix' => 'user', 'controller' => 'files', 'action' => 'add'], $linkConfig) ?></li>
