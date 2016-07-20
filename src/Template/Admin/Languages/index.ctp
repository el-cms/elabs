<?php
/*
 * File:
 *   src/Templates/Admin/Languages/index.ctp
 * Description:
 *   Administration - List of languages, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('languages', 'Admin/Languages&gt; List'));

// Block: Page actions
// -------------------
$this->start('pageActions');
echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('plus'), 'New language']), ['action' => 'add'], ['class' => 'btn btn-success btn-block', 'escape' => false]);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', ['label'=>'ISO 639-2 (id)']) ?></th>
                <th><?= $this->Paginator->sort('iso639_1', ['label'=>'ISO 639-1']) ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($languages as $language): ?>
                <tr>
                    <td><?= h($language->id) ?></td>
                    <td><?= h($language->iso639_1) ?></td>
                    <td><?= h($language->name) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('elabs', 'View online')]), ['prefix' => false, 'action' => 'view', $language->id], ['class' => 'btn btn-primary', 'escape' => false]);
                            echo $this->Html->link($this->Html->icon('pencil', ['title' => __d('elabs', 'Edit')]), ['action' => 'edit', $language->id], ['class' => 'btn btn-primary', 'escape' => false]);
                            echo $this->Form->postLink($this->Html->icon('trash', ['title' => __d('elabs', 'Delete')]), ['action' => 'delete', $language->id], ['confirm' => __('Are you sure you want to delete # {0}?', $language->id), 'class' => 'btn btn-danger', 'escape' => false]);
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
