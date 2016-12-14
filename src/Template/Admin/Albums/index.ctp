<?php
/*
 * File:
 *   src/Templates/Admin/Albums/index.ctp
 * Description:
 *   Administration - List of albums, sortable
 * Layout element:
 *   adminindex.ctp
 *
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('elabs', 'List of files'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('name', __d('elabs', 'Name')) ?></th>
                <th><?php echo $this->Paginator->sort('Users.username', __d('elabs', 'Owner')) ?></th>
                <th><?php echo $this->Paginator->sort('sfw', __d('elabs', 'SFW')) ?></th>
                <th>
                    <?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?><br/>
                    <?php echo $this->Paginator->sort('modified', __d('elabs', 'Modification date')) ?>
                </th>
                <th><?php echo $this->Paginator->sort('Languages.name', __d('elabs', 'Language')) ?></th>
                <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($albums as $album): ?>
                <tr>
                    <td>
                        <small><?php echo $this->Html->iconT('font', h($album->name)) ?></small><br/>
                    </td>
                    <td><?php echo $this->Html->link(h($album->user->username), ['controller' => 'users', 'action' => 'view', $album->user->id]) ?></td>
                    <td><?php echo $this->ItemsAdmin->sfwLabel($album->sfw) ?></td>
                    <td>
                        <small><?php echo $this->Html->iconT('asterisk', h($album->created)) ?></small><br/>
                        <small><?php echo $this->Html->iconT('refresh', h($album->modified)) ?></small>
                    </td>
                    <td><?php echo $this->Html->langLabel($album->language->name, $album->language->iso639_1) ?></td>
                    <td><?php echo $this->ItemsAdmin->statusLabel($album->status) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('elabs', 'Full details')]), ['action' => 'view', $album->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Lock/unlock
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('elabs', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('elabs', 'Lock')]);
                            if ($album->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $album->id, 'unlock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            elseif ($album->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $album->id, 'lock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            // Close
                            if ($album->status != 3):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('elabs', 'Close')]), ['action' => 'changeState', $album->id, 'remove'], [
                                    'class' => 'btn btn-danger',
                                    'confirm' => __d('elabs', 'Are you sure you want to close this ?'),
                                    'escape' => false
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
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
echo $this->element('layouts/adminindex');
