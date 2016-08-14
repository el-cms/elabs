<div class="clearfix">
    <div class="footer-logo">
        <a href="/"><?php echo $this->Html->image('logo-32.png', ['alt' => __d('elabs', 'Logo'), 'title' => __dx('elabs-x', '[site name] - logo', '{0} - logo', Cake\Core\Configure::read('cms.siteName'))]) ?> <?php echo Cake\Core\Configure::read('cms.siteName') ?></a>
    </div>
    <dl class="footer-nav">
        <dt class="nav-title"><?php echo __d('elabs', 'About the site') ?></dt>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'About'), ['prefix' => false, 'plugin' => null, 'controller' => 'pages', 'action' => 'display', 'about']) ?></dd>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'Sources'), 'https://github.com/el-cms/elabs') ?></dd>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'Issues'), 'https://github.com/el-cms/elabs/issues') ?></dd>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'Licenses used'), ['prefix' => false, 'plugin' => null, 'controller' => 'Licenses', 'action' => 'index']) ?></dd>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'Available languages'), ['prefix' => false, 'plugin' => null, 'controller' => 'Languages', 'action' => 'index']) ?></dd>
    </dl>
    <dl class="footer-nav">
        <dt class="nav-title"><?php echo __d('elabs', 'About the author') ?></dt>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'CV'), Cake\Core\Configure::read('cms.adminCVUrl')) ?></dd>
        <dd class="nav-item"><?php echo __d('elabs', 'Contact') ?></dd>
    </dl>
</div>