<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Acts'), ['controller' => 'Acts', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Act'), ['controller' => 'Acts', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?php echo $this->Form->create($user) ?>
    <fieldset>
        <legend><?php echo __('Add User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('username');
            echo $this->Form->input('realname');
            echo $this->Form->input('password');
            echo $this->Form->input('website');
            echo $this->Form->input('bio');
            echo $this->Form->input('role');
            echo $this->Form->input('see_nsfw');
            echo $this->Form->input('status');
            echo $this->Form->input('locked');
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
