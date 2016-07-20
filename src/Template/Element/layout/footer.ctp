<div class="clearfix">
    <div class="footer-logo">
        <a href="/"><?php echo $this->Html->image('logo-32.png', ['alt' => __('Logo'), 'title' => __('{0} logo', Cake\Core\Configure::read('cms.siteName'))]) ?> <?php echo Cake\Core\Configure::read('cms.siteName') ?></a>
    </div>
    <dl class="footer-nav">
        <dt class="nav-title">About the site</dt>
        <dd class="nav-item"><?php echo $this->Html->link(__('About'), ['prefix' => false, 'plugin' => null, 'controller' => 'Pages', 'action' => 'display', 'about']) ?></dd>
        <dd class="nav-item"><a href="https://github.com/el-cms/elabs">Sources</a></dd>
        <dd class="nav-item"><a href="https://github.com/el-cms/elabs/issues">Issues</a></dd>
        <dd class="nav-item"><?php echo $this->Html->link(__('Licenses used'), ['prefix' => false, 'plugin' => null, 'controller' => 'Licenses', 'action' => 'index']) ?></dd>
    </dl>
    <dl class="footer-nav">
        <dt class="nav-title">About the author</dt>
        <dd class="nav-item"><?php echo $this->Html->link(__d('elabs', 'CV'), Cake\Core\Configure::read('cms.adminCVUrl')) ?></dd>
        <dd class="nav-item">Contact</dd>
    </dl>
</div>