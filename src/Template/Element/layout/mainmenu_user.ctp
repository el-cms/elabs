<?php
$this->start('mainMenu');
?>
<li>
    <?php echo $this->Html->link($this->Html->iconT('chevron-left', __d('elabs', 'Back to website')), '/', ['escape' => false]) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Dashboard'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'dashboard', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Articles'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Projects'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Files'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Notes'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'notes', 'action' => 'index']) ?>
</li>
<li class="separator"></li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Comments'), ['prefix' => 'user', 'plugin' => null, 'controller' => 'comments', 'action' => 'index']) ?>
</li>

<?php
$this->end();
$this->start('secondMenu');
echo $this->element('layout/mainmenu_languages');
?>
<li>
    <?php echo $this->Html->reportLink(null, ['title' => __d('elabs', 'Report this page'), 'class' => '']) ?>
</li>
<?php
$this->end();
