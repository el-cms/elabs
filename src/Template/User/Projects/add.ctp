<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('List Projects'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Project Users'), ['controller' => 'ProjectUsers', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Project User'), ['controller' => 'ProjectUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="projects form large-9 medium-8 columns content">
    <?php echo $this->Form->create($project) ?>
    <fieldset>
        <legend><?php echo __('Add Project') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('short_description');
            echo $this->Form->input('description');
            echo $this->Form->input('sfw');
            echo $this->Form->input('download');
            echo $this->Form->input('license_id', ['options' => $licenses]);
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
