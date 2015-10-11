<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $act->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $act->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acts form large-9 medium-8 columns content">
    <?= $this->Form->create($act) ?>
    <fieldset>
        <legend><?= __('Edit Act') ?></legend>
        <?php
            echo $this->Form->input('model');
            echo $this->Form->input('fkid');
            echo $this->Form->input('type');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
