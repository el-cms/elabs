<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $file->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]
            )
        ?></li>
        <li><?php echo $this->Html->link(__('List Files'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?php echo $this->Html->link(__('List Itemfiles'), ['controller' => 'Itemfiles', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Itemfile'), ['controller' => 'Itemfiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="files form large-9 medium-8 columns content">
    <?php echo $this->Form->create($file) ?>
    <fieldset>
        <legend><?php echo __('Edit File') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('filename');
            echo $this->Form->input('weight');
            echo $this->Form->input('description');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
