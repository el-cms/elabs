<?php
$this->start('mainMenu');
?>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Home'), '/') ?>
</li>
<li>
    <?php echo $this->Html->link(__d('posts', 'Articles'), ['prefix' => false, 'plugin'=>null, 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('projects', 'Projects'), ['prefix' => false, 'plugin'=>null, 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('files', 'Files'), ['prefix' => false, 'plugin'=>null, 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('users', 'Authors'), ['prefix' => false, 'plugin'=>null, 'controller' => 'users', 'action' => 'index']) ?>
</li>

<?php
$this->end();
$this->start('secondMenu');
?>
<li>
    <?php echo $this->Html->Link(($seeNSFW === true) ? __d('elabs', 'Hide NSFW') : __d('elabs', 'Show NSFW'), ['plugin'=>null, 'prefix'=>false, 'action' => 'switchSFW', ($seeNSFW === true) ? 'hide' : 'show']) ?>
</li>
<li>
    <?php echo $this->Html->reportLink(null, ['title' => __d('reports', 'Report this page'), 'class' => '']) ?>
</li>
<?php
$this->end();
