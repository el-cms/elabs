<?php
$this->start('mainMenu');
$linkConfig = ['class' => 'waves-attach waves-effect', 'escape' => false];
?>
<li>
  <?php echo $this->Html->link(__d('admin', 'Dashboard'), '#', $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('posts', 'Articles'), ['prefix' => 'admin', 'controller' => 'posts', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('projects', 'Projects'), ['prefix' => 'admin', 'controller' => 'projects', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('files', 'Files'), ['prefix' => 'admin', 'controller' => 'files', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('users', 'Users'), ['prefix' => 'admin', 'controller' => 'users', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('licenses', 'Licenses'), ['prefix' => 'admin', 'controller' => 'licenses', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('tags', 'Tags'), ['prefix' => 'admin', 'controller' => 'tags', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('reports', 'Reports'), ['prefix' => 'admin', 'controller' => 'reports', 'action' => 'index'], $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('admin', 'Maintenance'), '#', $linkConfig) ?>
</li>
<?php
$this->end();
$this->start('secondMenu');
?>
<li>
  <?php echo $this->Html->link('<span class="fa fa-eye fa-fw"></span>&nbsp;' . __d('admin', 'View site online'), '/', $linkConfig) ?>
</li>
<li>
  <?php echo $this->Html->link('<span class="fa fa-sign-out fa-fw"></span>&nbsp;' . __d('users', 'Logout'), ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], $linkConfig) ?>
</li>
<?php
$this->end();
