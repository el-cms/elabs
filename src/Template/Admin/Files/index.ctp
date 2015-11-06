<table class="table table-condensed">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id') ?></th>
            <th><?php echo $this->Paginator->sort('name', __d('files', 'Name')) ?></th>
            <th><?php echo $this->Paginator->sort('Users.username', __d('elabs', 'Owner')) ?></th>
            <th><?php echo $this->Paginator->sort('filename', __d('files', 'File name')) ?></th>
            <th><?php echo $this->Paginator->sort('weight', __d('files', 'Size')) ?></th>
            <th><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?></th>
            <th><?php echo $this->Paginator->sort('modified', __d('elabs', 'Mod. date')) ?></th>
            <th><?php echo $this->Paginator->sort('Licenses.name', __d('licenses', 'License')) ?></th>
            <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
            <th class="actions"><?php echo __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?php echo $this->Number->format($file->id) ?></td>
                <td><?php echo h($file->name) ?></td>
                <td><?php echo $this->Html->link(h($file->user->username), ['controller' => 'users', 'action' => 'view', $file->user->id]) ?></td>
                <td><?php echo h($file->filename) ?></td>
                <td><?php echo $this->Number->format($file->weight) ?></td>
                <td><?php echo h($file->created) ?></td>
                <td><?php echo h($file->modified) ?></td>
                <td><?php echo $this->License->d($file->license, false) ?></td>
                <td><?php echo $this->ItemsAdmin->statusLabel($file->status) ?></td>
                <td class="padding-no">
                    <ul class="margin-no nav nav-list">
                        <li>
                            <?php
                            echo $this->Html->link('<span class="fa fa-eye" title="' . __d('admin', 'Full details') . '"></span>', ['action' => 'view', $file->id], [
                                'class' => 'text-sec waves-attach waves-effect',
                                'escape' => false
                            ]);
                            ?>
                        </li>
                        <li>
                            <?php
                            $unlockIcon = '<span class="fa fa-unlock-alt fa-fw" title="' . __d('admin', 'Unlock') . '"></span>';
                            $lockIcon = '<span class="fa fa-lock fa-fw" title="' . __d('admin', 'Lock') . '"></span>';
                            if ($file->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $file->id, 'unlock'], [
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                ]);
                            elseif ($file->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $file->id, 'lock'], [
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
                            if ($file->status != 3):
                                echo $this->Html->link('<span class="fa fa-times" title="' . __d('admin', 'Close') . '"></span>', ['action' => 'changeState', $file->id, 'remove'], [
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

