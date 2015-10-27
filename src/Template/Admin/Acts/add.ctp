<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('List Acts'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acts form large-9 medium-8 columns content">
    <?php echo $this->Form->create($act) ?>
    <fieldset>
        <legend><?php echo __('Add Act') ?></legend>
        <?php
            echo $this->Form->input('model');
            echo $this->Form->input('fkid');
            echo $this->Form->input('type');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
