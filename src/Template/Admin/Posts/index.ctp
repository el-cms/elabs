<?php
$this->assign('title', __d('posts', 'Admin/Articles&gt; List'));
?>
<table class="table table-condensed">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id') ?></th>
            <th><?php echo $this->Paginator->sort('title', __d('posts', 'Title')) ?></th>
            <th><?php echo $this->Paginator->sort('Users.username', __d('elabs', 'Author')) ?></th>
            <th><?php echo $this->Paginator->sort('sfw', __d('elabs', 'SFW')) ?></th>
            <th><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?></th>
            <th><?php echo $this->Paginator->sort('modified', __d('elabs', 'Mod. date')) ?></th>
            <th><?php echo $this->Paginator->sort('Licenses.name', __d('licenses', 'License')) ?></th>
            <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
            <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post->id ?></td>
                <td><?php echo h($post->title) ?></td>
                <td><?php echo $this->Html->link(h($post->user->username), ['controller' => 'users', 'action' => 'view', $post->user->id]) ?></td>
                <td><?php echo $this->ItemsAdmin->sfwLabel($post->sfw) ?></td>
                <td><?php echo h($post->created) ?></td>
                <td><?php echo h($post->modified) ?></td>
                <td><?php echo $this->License->d($post->license, false) ?></td>
                <td><?php echo $this->ItemsAdmin->statusLabel($post->status) ?></td>
                <td class="padding-no">
                    <ul class="margin-no nav nav-list">
                        <li>
                            <?php
                            echo $this->Html->link('<span class="fa fa-eye" title="' . __d('admin', 'Full details') . '"></span>', ['action' => 'view', $post->id], [
                                'class' => 'text-sec waves-attach waves-effect',
                                'escape' => false
                            ]);
                            ?>
                        </li>
                        <li>
                            <?php
                            $unlockIcon = '<span class="fa fa-unlock-alt fa-fw" title="' . __d('admin', 'Unlock') . '"></span>';
                            $lockIcon = '<span class="fa fa-lock fa-fw" title="' . __d('admin', 'Lock') . '"></span>';
                            if ($post->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $post->id, 'unlock'], [
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                ]);
                            elseif ($post->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $post->id, 'lock'], [
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                ]);
                            else:
                                echo '<a class="text-sec disabled"><span class="fa fa-fw"></span></a>';
                            endif;
                            ?>
                        </li>
                        <li>
                            <?php
                            if ($post->status != 3):
                                echo $this->Html->link('<span class="fa fa-times" title="' . __d('admin', 'Close') . '"></span>', ['action' => 'changeState', $post->id, 'remove'], [
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false
                                ]);
                            endif;
                            ?>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
echo $this->element('layout/paginationlinks');
