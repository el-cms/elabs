<?php
$this->start('mainMenu');
?>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Dashboard'), '#') ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Articles'), ['prefix' => 'admin', 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Projects'), ['prefix' => 'admin', 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Files'), ['prefix' => 'admin', 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Users'), ['prefix' => 'admin', 'controller' => 'users', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Licenses'), ['prefix' => 'admin', 'controller' => 'licenses', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Languages'), ['prefix' => 'admin', 'controller' => 'languages', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Tags'), ['prefix' => 'admin', 'controller' => 'tags', 'action' => 'index']) ?>
</li>
<li>
    <?php echo $this->Html->link(__d('elabs', 'Reports'), ['prefix' => 'admin', 'controller' => 'reports', 'action' => 'index']) ?>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __d('elabs', 'Maintenance') ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li class="dropdown-header">Acts:</li>
        <li><?php echo $this->Form->postLink(__('{0}&nbsp;{1}', [$this->Html->icon('refresh'), __('Rebuild table')]), ['controller' => 'Acts', 'action' => 'clean'], ['escape' => false, 'confirm' => _('Are you sure you want to clear the table and rebuild it ?')]) ?></li>
        <li class="dropdown-header">General</li>
        <li><?php echo $this->Form->postLink(__('{0}&nbsp;{1}', [$this->Html->icon('trash'), __('Clear the caches')]), ['controller' => 'Maintenance', 'action' => 'clearCache'], ['escape' => false, 'confirm' => _('Are you sure you want to clear the caches ?')]) ?></li>
    </ul>
</li>
<li>

</li>
<?php
$this->end();
$this->start('secondMenu');
?>
<li>
    <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon('eye'), __d('elabs', 'View site online')]), '/', ['target' => '_blank']) ?>
</li>
<li>
    <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon('sign-out'), __d('elabs', 'Logout')]), ['prefix' => false, 'controller' => 'users', 'action' => 'logout']) ?>
</li>
<?php
$this->end();
