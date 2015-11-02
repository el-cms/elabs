<?php
$this->assign('title', h($license->name));

$this->start('pageActions');
?>
<nav class="nav nav-list">
    <ul class="dl-horizontal">
        <li><?php echo $this->Html->link(__('Edit License'), ['action' => 'edit', $license->id]) ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete License'), ['action' => 'delete', $license->id], ['confirm' => __('Are you sure you want to delete # {0}?', $license->id)]) ?> </li>
        <li><?php echo $this->Html->link(__('List Licenses'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<?php
$this->end();
$this->start('pageInfos');
?>
<dl class="dl-horizontal">
    <dt><?php echo __('Id') ?></dt>
    <dd><?php echo $this->Number->format($license->id) ?></dd>
    <dt><?php echo __('Name') ?></dt>
    <dd><?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-' . $license->icon . ' fa-fw"></span>', h($license->name)]), $license->link, ['escape' => false]) ?></dd>
    <dt><?php echo __('Posts') ?></dt>
    <dd><?php echo $this->Number->format($license->post_count) ?></dd>
    <dt><?php echo __('Projects') ?></dt>
    <dd><?php echo $this->Number->format($license->project_count) ?></dd>
    <dt><?php echo __('Files') ?></dt>
    <dd><?php echo $this->Number->format($license->file_count) ?></dd>
</dl>
<?php
$this->end();
$this->start('pageContent');
?>

<nav class="tab-nav tab-nav-brand">
    <ul class="nav nav-justified">
        <li class="active">
            <a class="waves-attach waves-effect" data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Related articles') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Related projects') ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Related files') ?></a>
        </li>
    </ul>
    <div class="tab-nav-indicator"></div>
</nav>

<div class="tab-pane fade active in" id="posts-tab">
    <?php if (!empty($license->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Title') ?></th>
                <th><?php echo __('Excerpt') ?></th>
                <th><?php echo __('Text') ?></th>
                <th><?php echo __('Sfw') ?></th>
                <th><?php echo __('Created') ?></th>
                <th><?php echo __('Modified') ?></th>
                <th><?php echo __('Published') ?></th>
                <th><?php echo __('Publication Date') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th><?php echo __('License Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($license->posts as $posts): ?>
                <tr>
                    <td><?php echo h($posts->id) ?></td>
                    <td><?php echo h($posts->title) ?></td>
                    <td><?php echo h($posts->excerpt) ?></td>
                    <td><?php echo h($posts->text) ?></td>
                    <td><?php echo h($posts->sfw) ?></td>
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
    <?php else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>

<div class="tab-pane fade" id="projects-tab">
<?php if (!empty($license->projects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Name') ?></th>
                <th><?php echo __('Short Description') ?></th>
                <th><?php echo __('Description') ?></th>
                <th><?php echo __('Sfw') ?></th>
                <th><?php echo __('Mainurl') ?></th>
                <th><?php echo __('Created') ?></th>
                <th><?php echo __('Modified') ?></th>
                <th><?php echo __('License Id') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
    <?php foreach ($license->projects as $projects): ?>
                <tr>
                    <td><?php echo h($projects->id) ?></td>
                    <td><?php echo h($projects->name) ?></td>
                    <td><?php echo h($projects->short_description) ?></td>
                    <td><?php echo h($projects->description) ?></td>
                    <td><?php echo h($projects->sfw) ?></td>
                    <td><?php echo h($projects->mainurl) ?></td>
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
    <?php
    else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>

<div class="tab-pane fade" id="files-tab">
<?php if (!empty($license->files)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo __('Id') ?></th>
                <th><?php echo __('Name') ?></th>
                <th><?php echo __('Filename') ?></th>
                <th><?php echo __('Weight') ?></th>
                <th><?php echo __('Description') ?></th>
                <th><?php echo __('Created') ?></th>
                <th><?php echo __('Modified') ?></th>
                <th><?php echo __('User Id') ?></th>
                <th><?php echo __('License Id') ?></th>
                <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
    <?php foreach ($license->files as $files): ?>
                <tr>
                    <td><?php echo h($files->id) ?></td>
                    <td><?php echo h($files->name) ?></td>
                    <td><?php echo h($files->filename) ?></td>
                    <td><?php echo h($files->weight) ?></td>
                    <td><?php echo h($files->description) ?></td>
                    <td><?php echo h($files->created) ?></td>
                    <td><?php echo h($files->modified) ?></td>
                    <td><?php echo h($files->user_id) ?></td>
                    <td><?php echo h($files->license_id) ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $files->id]) ?>

        <?php echo $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $files->id]) ?>

                <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ['confirm' => __('Are you sure you want to delete # {0}?', $files->id)]) ?>

                    </td>
                </tr>
        <?php endforeach; ?>
        </table>
        <?php
    else:
        echo $this->element('layout/empty_admin');
    endif;
    ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
