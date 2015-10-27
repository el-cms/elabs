<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posts form large-9 medium-8 columns content">
    <?php echo $this->Form->create($post) ?>
    <fieldset>
        <legend><?php echo __('Add Post') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('excerpt');
            echo $this->Form->input('text');
            echo $this->Form->input('sfw');
            echo $this->Form->input('anon');
            echo $this->Form->input('published');
            echo $this->Form->input('publication_date');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('license_id', ['options' => $licenses]);
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
