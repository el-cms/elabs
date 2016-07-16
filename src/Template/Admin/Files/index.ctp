<?php
/*
 * File:
 *   src/Templates/Admin/Files/index.ctp
 * Description:
 *   Administration - List of files, sortable
 * Layout element:
 *   defaultindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('files', 'Admin/Files&gt; List'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('name', __d('files', 'Name')) ?>/<?php echo $this->Paginator->sort('filename', __d('files', 'F.name')) ?></th>
                <th><?php echo $this->Paginator->sort('Users.username', __d('elabs', 'Owner')) ?></th>
                <th><?php echo $this->Paginator->sort('weight', __d('files', 'Size')) ?></th>
                <th><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?>/<?php echo $this->Paginator->sort('modified', __d('elabs', 'Mod. date')) ?></th>
                <th><?php echo $this->Paginator->sort('Licenses.name', __d('licenses', 'License')) ?></th>
                <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('font'), h($file->name)]) ?></small><br/>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('file-o'), h($file->filename)]) ?></small>
                    </td>
                    <td><?php echo $this->Html->link(h($file->user->username), ['controller' => 'users', 'action' => 'view', $file->user->id]) ?></td>
                    <td><?php echo $file->weight ?></td>
                    <td>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('asterisk'), h($file->created)]) ?></small><br/>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('refresh'), h($file->modified)]) ?></small>
                    </td>
                    <td><?php echo $this->License->d($file->license, false) ?></td>
                    <td><?php echo $this->ItemsAdmin->statusLabel($file->status) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('admin', 'Full details')]), ['action' => 'view', $file->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Lock/unlock
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('admin', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('admin', 'Lock')]);
                            if ($file->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $file->id, 'unlock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            elseif ($file->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $file->id, 'lock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?= $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            // Close
                            if ($file->status != 3):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('admin', 'Close')]), ['action' => 'changeState', $file->id, 'remove'], [
                                    'class' => 'btn btn-danger',
                                    'confirm' => __d('files', 'Are you sure you want to close this ?'),
                                    'escape' => false
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?= $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
