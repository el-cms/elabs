<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemtag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemtag->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Itemtags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemtags form large-9 medium-8 columns content">
    <?= $this->Form->create($itemtag) ?>
    <fieldset>
        <legend><?= __('Edit Itemtag') ?></legend>
        <?php
            echo $this->Form->input('model');
            echo $this->Form->input('fkid');
            echo $this->Form->input('tag_id', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
