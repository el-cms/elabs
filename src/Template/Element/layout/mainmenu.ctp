<?php
$this->start('mainMenu');
?>
<li>
  <?php echo $this->Html->link('Home', '/', ['class' => 'waves-attach']) ?>
</li>
<li>
  <?php echo $this->Html->link('News', ['prefix' => false, 'controller' => 'posts', 'action' => 'index'], ['class' => 'waves-attach']) ?>
</li>
<li>
  <?php echo $this->Html->link('Projects', ['prefix' => false, 'controller' => 'projects', 'action' => 'index'], ['class' => 'waves-attach']) ?>
</li>
<li>
  <?php echo $this->Html->link('Files', ['prefix' => false, 'controller' => 'files', 'action' => 'index'], ['class' => 'waves-attach']) ?>
</li>
<li>
  <?php echo $this->Html->link('Authors', ['prefix' => false, 'controller' => 'users', 'action' => 'index'], ['class' => 'waves-attach']) ?>
</li>

<?php
$this->end();
$this->start('secondMenu');
?>
<li>
  <?php echo $this->Html->Link(($see_nsfw === true) ? __d('elabs', 'Hide NSFW') : __d('elabs', 'Show NSFW'), ['action' => 'switchSFW', ($see_nsfw === true) ? 'hide' : 'show']) ?>
</li>
<li>
  <?php echo $this->Html->link('About', ['prefix' => false, 'controller' => 'pages', 'action' => 'display', 'about'], ['class' => 'waves-attach']) ?>
</li>
<?php
$this->end();
