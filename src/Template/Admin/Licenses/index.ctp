<?php
$this->assign('title', __d('licenses', 'Licenses'));

$this->start('pageActionsMenu');
echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'New license']), ['action' => 'add'], ['class' => 'btn btn-green waves-attach waves-button waves-effect', 'escape' => false]);
$this->end();

$this->start('pageContent');
?>
<table class="table table-condensed">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id') ?></th>
            <th><?php echo $this->Paginator->sort('name', __d('licenses', 'Name')) ?></th>
            <th><?php echo $this->Paginator->sort('link', __d('licenses', 'Link')) ?></th>
            <th><?php echo $this->Paginator->sort('post_count', __d('licenses', 'Posts')) ?></th>
            <th><?php echo $this->Paginator->sort('project_count', __d('licenses', 'Projects')) ?></th>
            <th><?php echo $this->Paginator->sort('file_count', __d('licenses', 'Files')) ?></th>
            <th class="actions"><?php echo __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!$licenses->isEmpty()):
            foreach ($licenses as $license):
                ?>
                <tr>
                    <td><?php echo $this->Number->format($license->id) ?></td>
                    <td><?php echo __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-' . $license->icon . ' fa-fw"></span>', h($license->name)]) ?></td>
                    <td><?php echo $this->Html->link(h($license->link), h($license->link)) ?></td>
                    <td><?php echo h($license->post_count) ?></td>
                    <td><?php echo h($license->project_count) ?></td>
                    <td><?php echo h($license->file_count) ?></td>
                    <td class="padding-no">
                        <ul  class="margin-no nav nav-list">
                            <li>
                                <?php
                                echo $this->Html->link('<span class="fa fa-pencil" title="' . __d('admin', 'Edit') . '"></span>', ['action' => 'edit', $license->id], [
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false
                                ]);
                                ?>
                            </li>
                            <li>
                                <?php
                                echo $this->Form->postLink('<span class="fa fa-trash" title="' . __d('admin', 'Delete') . '"></span>', ['action' => 'delete', $license->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $license->id),
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false])
                                ?>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="7" class="text-center"><?php echo __d('licenses', 'You have no licenses yet. Please add one.') ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
$this->end();

echo $this->element('layouts/defaultindex');

