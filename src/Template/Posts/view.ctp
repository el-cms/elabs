<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post'), ['action' => 'edit', $post->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="posts view large-9 medium-8 columns content">
    <h3><?= h($post->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($post->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Excerpt') ?></th>
            <td><?= h($post->excerpt) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('License') ?></th>
            <td><?= $post->has('license') ? $this->Html->link($post->license->name, ['controller' => 'Licenses', 'action' => 'view', $post->license->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($post->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($post->modified) ?></tr>
        </tr>
        <tr>
            <th><?= __('Publication Date') ?></th>
            <td><?= h($post->publication_date) ?></tr>
        </tr>
        <tr>
            <th><?= __('Sfw') ?></th>
            <td><?= $post->sfw ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Anon') ?></th>
            <td><?= $post->anon ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Published') ?></th>
            <td><?= $post->published ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Markdown->transform($post->text); ?>
    </div>
</div>
<?php 
$this->start('pageBottomScripts');
echo $this->element('layout/prismload');
$this->end();
