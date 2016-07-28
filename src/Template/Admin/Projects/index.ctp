<?php
/*
 * File:
 *   src/Templates/Admin/Projects/index.ctp
 * Description:
 *   Administration - List of projects, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('elabs', 'List of projects'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Projects'), ['action' => 'index']);
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
                    <?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?><br />
                    <?php echo $this->Paginator->sort('modified', __d('elabs', 'Mod. date')) ?>
                </th>
                <th><?php echo $this->Paginator->sort('Licenses.name', __d('elabs', 'License')) ?></th>
                <th><?php echo $this->Paginator->sort('Languages.name', __d('elabs', 'Language')) ?></th>
                <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo $this->Html->langLabel($project->name, $project->language->iso639_1, ['label' => false]) ?></td>
                    <td><?php echo $this->Html->link(h($project->user->username), ['controller' => 'users', 'action' => 'view', $project->user->id]) ?></td>
                    <td><?php echo $this->ItemsAdmin->sfwLabel($project->sfw) ?></td>
                    <td>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('asterisk'), h($project->created)]) ?></small><br/>
                        <small><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('refresh'), h($project->modified)]) ?></small>
                    </td>
                    <td><?php echo $this->License->d($project->license, false) ?></td>
                    <td><?php echo $this->Html->langLabel($project->language->name, $project->language->iso639_1) ?></td>
                    <td><?php echo $this->ItemsAdmin->statusLabel($project->status) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('elabs', 'Full details')]), ['action' => 'view', $project->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Lock/unlock
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('elabs', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('elabs', 'Lock')]);
                            if ($project->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $project->id, 'unlock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            elseif ($project->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $project->id, 'lock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            // Close
                            if ($project->status != 3):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('elabs', 'Close')]), ['action' => 'changeState', $project->id, 'remove'], [
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
