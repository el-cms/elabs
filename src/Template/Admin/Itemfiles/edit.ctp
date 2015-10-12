<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemfile->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemfile->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Itemfiles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemfiles form large-9 medium-8 columns content">
    <?= $this->Form->create($itemfile) ?>
    <fieldset>
        <legend><?= __('Edit Itemfile') ?></legend>
        <?php
            echo $this->Form->input('model');
            echo $this->Form->input('fkid');
            echo $this->Form->input('file_id', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
