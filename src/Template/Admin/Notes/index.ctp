<?php
/*
 * File:
 *   src/Templates/Admin/Notes/index.ctp
 * Description:
 *   Administration - List of notes, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('elabs', 'Notes list'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('text', __d('elabs', 'Text')) ?></th>
                <th><?php echo $this->Paginator->sort('Users.username', __d('elabs', 'Author')) ?></th>
                <th><?php echo $this->Paginator->sort('sfw', __d('elabs', 'SFW')) ?></th>
                <th>
                    <?php echo $this->Paginator->sort('modified', __d('elabs', 'Mod. date')) ?><br/>
                    <?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?>
                </th>
                <th><?php echo $this->Paginator->sort('Licenses.name', __d('elabs', 'License')) ?></th>
                <th><?php echo $this->Paginator->sort('Languages.name', __d('elabs', 'Language')) ?></th>
                <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?php echo h($note->text) ?></td>
                    <td><?php echo $this->Html->link(h($note->user->username), ['controller' => 'users', 'action' => 'view', $note->user->id]) ?></td>
                    <td><?php echo $this->ItemsAdmin->sfwLabel($note->sfw) ?></td>
                    <td>
                        <small><?php echo $this->Html->iconT('asterisk', h($note->created)) ?></small><br/>
                        <small><?php echo $this->Html->iconT('refresh', h($note->modified)) ?></small>
                    </td>
                    <td><?php echo $this->License->d($note->license, false) ?></td>
                    <td><?php echo $this->Html->langLabel($note->language->name, $note->language->iso639_1) ?></td>
                    <td><?php echo $this->ItemsAdmin->statusLabel($note->status) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('elabs', 'Full details')]), ['action' => 'view', $note->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Lock/unlock
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('elabs', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('elabs', 'Lock')]);
                            if ($note->status === STATUS_LOCKED):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $note->id, 'unlock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            elseif ($note->status === STATUS_PUBLISHED):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $note->id, 'lock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            // Close
                            if ($note->status != STATUS_DELETED):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('elabs', 'Close')]), ['action' => 'changeState', $note->id, 'remove'], [
                                    'class' => 'btn btn-danger',
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
