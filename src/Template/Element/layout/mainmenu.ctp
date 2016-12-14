<?php
$this->start('mainMenu');
?>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Home'), '/') ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Articles'), ['prefix' => false, 'plugin' => null, 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Projects'), ['prefix' => false, 'plugin' => null, 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Files'), ['prefix' => false, 'plugin' => null, 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Albums'), ['prefix' => false, 'plugin' => null, 'controller' => 'albums', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Notes'), ['prefix' => false, 'plugin' => null, 'controller' => 'notes', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Authors'), ['prefix' => false, 'plugin' => null, 'controller' => 'users', 'action' => 'index']) ?>
</li>

<?php
$this->end();
$this->start('secondMenu');
?>
<li>
    <?php echo $this->Html->Link(($seeNSFW === true) ? __d('elabs', 'Hide NSFW') : __d('elabs', 'Show NSFW'), ['plugin' => null, 'prefix' => false, 'action' => 'switchSFW', ($seeNSFW === true) ? 'hide' : 'show']) ?>
</li>
<?php echo $this->element('layout/mainmenu_languages'); ?>
<li>
    <?php echo $this->Html->reportLink(null, ['title' => __d('elabs', 'Report this page'), 'class' => '']) ?>
</li>
<?php
$this->end();
