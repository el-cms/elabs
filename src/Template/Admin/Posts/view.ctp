<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit Post'), ['action' => 'edit', $post->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Posts'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Post'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New License'), ['controller' => 'Licenses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="posts view large-9 medium-8 columns content">
    <h3><?php echo h($post->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Title') ?></th>
            <td><?php echo h($post->title) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Excerpt') ?></th>
            <td><?php echo h($post->excerpt) ?></td>
        </tr>
        <tr>
            <th><?php echo __('User') ?></th>
            <td><?php echo $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('License') ?></th>
            <td><?php echo $post->has('license') ? $this->Html->link($post->license->name, ['controller' => 'Licenses', 'action' => 'view', $post->license->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Created') ?></th>
            <td><?php echo h($post->created) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Modified') ?></th>
            <td><?php echo h($post->modified) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Publication Date') ?></th>
            <td><?php echo h($post->publication_date) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Sfw') ?></th>
            <td><?php echo $post->sfw ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?php echo __('Anon') ?></th>
            <td><?php echo $post->anon ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?php echo __('Published') ?></th>
            <td><?php echo $post->published ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?php echo __('Text') ?></h4>
        <?php echo $this->Text->autoParagraph(h($post->text)); ?>
    </div>
</div>
