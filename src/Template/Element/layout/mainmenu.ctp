<?php
$this->start('mainMenu');
?>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Home'), '/') ?>
</li>
<li>
    <?php echo $this->Html->link(__d('posts', 'Articles'), ['prefix' => false, 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('projects', 'Projects'), ['prefix' => false, 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('files', 'Files'), ['prefix' => false, 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('users', 'Authors'), ['prefix' => false, 'controller' => 'users', 'action' => 'index']) ?>
</li>

<?php
$this->end();
$this->start('secondMenu');
?>
<li>
    <?php echo $this->Html->Link(($see_nsfw === true) ? __d('elabs', 'Hide NSFW') : __d('elabs', 'Show NSFW'), ['action' => 'switchSFW', ($see_nsfw === true) ? 'hide' : 'show']) ?>
</li>
<li>
    <?php echo $this->Html->reportLink(null, ['title' => __d('reports', 'Report this page'), 'class' => '']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'About'), ['prefix' => false, 'controller' => 'pages', 'action' => 'display', 'about']) ?>
</li>
<?php
$this->end();
