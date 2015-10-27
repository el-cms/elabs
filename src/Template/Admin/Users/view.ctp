<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Acts'), ['controller' => 'Acts', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Act'), ['controller' => 'Acts', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
        <li><?php echo $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?php echo $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?php echo h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?php echo __('Email') ?></th>
            <td><?php echo h($user->email) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Username') ?></th>
            <td><?php echo h($user->username) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Realname') ?></th>
            <td><?php echo h($user->realname) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Password') ?></th>
            <td><?php echo h($user->password) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Website') ?></th>
            <td><?php echo h($user->website) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Role') ?></th>
            <td><?php echo h($user->role) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Id') ?></th>
            <td><?php echo $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?php echo __('Created') ?></th>
            <td><?php echo h($user->created) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('Modified') ?></th>
            <td><?php echo h($user->modified) ?></tr>
        </tr>
        <tr>
            <th><?php echo __('See Nsfw') ?></th>
            <td><?php echo $user->see_nsfw ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?php echo __('Status') ?></th>
            <td><?php echo $user->status ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?php echo __('Locked') ?></th>
            <td><?php echo $user->locked ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="row">
        <h4><?php echo __('Bio') ?></h4>
        <?php echo $this->Text->autoParagraph(h($user->bio)); ?>
    </div>
    <div class="related">
        <h4><?php echo __('Related Acts') ?></h4>
        <?php if (!empty($user->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Model') ?></th>
                <th><?php echo __('Fkid') ?></th>
                <th><?php echo __('Type') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($user->events as $events): ?>
            <tr>
                <td><?php echo h($events->id) ?></td>
                <td><?php echo h($events->model) ?></td>
                <td><?php echo h($events->fkid) ?></td>
                <td><?php echo h($events->type) ?></td>
                <td><?php echo h($events->user_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Acts', 'action' => 'view', $events->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Acts', 'action' => 'edit', $events->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Acts', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?php echo __('Related Posts') ?></h4>
        <?php if (!empty($user->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Title') ?></th>
                <th><?php echo __('Excerpt') ?></th>
                <th><?php echo __('Text') ?></th>
                <th><?php echo __('Sfw') ?></th>
                <th><?php echo __('Anon') ?></th>
                <th><?php echo __('Created') ?></th>
                <th><?php echo __('Modified') ?></th>
                <th><?php echo __('Published') ?></th>
                <th><?php echo __('Publication Date') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th><?php echo __('License Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($user->posts as $posts): ?>
            <tr>
                <td><?php echo h($posts->id) ?></td>
                <td><?php echo h($posts->title) ?></td>
                <td><?php echo h($posts->excerpt) ?></td>
                <td><?php echo h($posts->text) ?></td>
                <td><?php echo h($posts->sfw) ?></td>
                <td><?php echo h($posts->anon) ?></td>
                <td><?php echo h($posts->created) ?></td>
                <td><?php echo h($posts->modified) ?></td>
                <td><?php echo h($posts->published) ?></td>
                <td><?php echo h($posts->publication_date) ?></td>
                <td><?php echo h($posts->user_id) ?></td>
                <td><?php echo h($posts->license_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?php echo __('Related Projects') ?></h4>
        <?php if (!empty($user->projects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Name') ?></th>
                <th><?php echo __('Short Description') ?></th>
                <th><?php echo __('Description') ?></th>
                <th><?php echo __('Sfw') ?></th>
                <th><?php echo __('Download') ?></th>
                <th><?php echo __('Created') ?></th>
                <th><?php echo __('Modified') ?></th>
                <th><?php echo __('License Id') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($user->projects as $projects): ?>
            <tr>
                <td><?php echo h($projects->id) ?></td>
                <td><?php echo h($projects->name) ?></td>
                <td><?php echo h($projects->short_description) ?></td>
                <td><?php echo h($projects->description) ?></td>
                <td><?php echo h($projects->sfw) ?></td>
                <td><?php echo h($projects->download) ?></td>
                <td><?php echo h($projects->created) ?></td>
                <td><?php echo h($projects->modified) ?></td>
                <td><?php echo h($projects->license_id) ?></td>
                <td><?php echo h($projects->user_id) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>

                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>

                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
