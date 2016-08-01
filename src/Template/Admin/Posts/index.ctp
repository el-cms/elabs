<?php
/*
 * File:
 *   src/Templates/Admin/Posts/index.ctp
 * Description:
 *   Administration - List of posts, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('elabs', 'List of articles'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('title', __d('elabs', 'Title')) ?></th>
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
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo h($post->title) ?></td>
                    <td><?php echo $this->Html->link(h($post->user->username), ['controller' => 'users', 'action' => 'view', $post->user->id]) ?></td>
                    <td><?php echo $this->ItemsAdmin->sfwLabel($post->sfw) ?></td>
                    <td>
                        <small><?php echo $this->Html->iconT('asterisk', h($post->created)) ?></small><br/>
                        <small><?php echo $this->Html->iconT('refresh', h($post->modified)) ?></small>
                    </td>
                    <td><?php echo $this->License->d($post->license, false) ?></td>
                    <td><?php echo $this->Html->langLabel($post->language->name, $post->language->iso639_1) ?></td>
                    <td><?php echo $this->ItemsAdmin->statusLabel($post->status) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            // See content
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('elabs', 'Full details')]), ['action' => 'view', $post->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Lock/unlock
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('elabs', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('elabs', 'Lock')]);
                            if ($post->status === 2):
                                echo $this->Html->link($unlockIcon, ['action' => 'changeState', $post->id, 'unlock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            elseif ($post->status === 1):
                                echo $this->Html->link($lockIcon, ['action' => 'changeState', $post->id, 'lock'], [
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            // Close
                            if ($post->status != 3):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('elabs', 'Close')]), ['action' => 'changeState', $post->id, 'remove'], [
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
