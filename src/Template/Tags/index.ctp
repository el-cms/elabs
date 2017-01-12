<?php
/*
 * File:
 *   src/Templates/Tags/index.ctp
 * Description:
 *   List of tags, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Tags'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Tags'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'List of tags'));


// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('id', __d('elabs', 'Name'));
echo $this->Paginator->sort('album_count', __d('elabs', 'Number of albums'));
echo $this->Paginator->sort('file_count', __d('elabs', 'Number of files'));
echo $this->Paginator->sort('note_count', __d('elabs', 'Number of notes'));
echo $this->Paginator->sort('post_count', __d('elabs', 'Number of articles'));
echo $this->Paginator->sort('project_count', __d('elabs', 'Number of projects'));
$this->end();
// Block: Page content
// -------------------
$this->start('pageContent');
if (!$tags->isEmpty()):
?>
<table>
    <thead>
        <tr>
            <th scope="col"><?php echo __d('elabs', 'Name') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Number of albums') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Number of files') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Number of notes') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Number of articles') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Number of projects') ?></th>
            <th scope="col"><?php echo __d('elabs', 'Total') ?></th>
        </tr>
    </thead>
    <tbody class="table-hover">
        <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?php echo $this->Html->link(h($tag->id), ['action' => 'view', h($tag->id)]) ?></td>
                <td><?php echo $this->Html->link($this->Number->format($tag->album_count), ['controller' => 'Albums', 'action' => 'index', 'tag', h($tag->id)]) ?></td>
                <td><?php echo $this->Html->link($this->Number->format($tag->file_count), ['controller' => 'Files', 'action' => 'index', 'tag', h($tag->id)]) ?></td>
                <td><?php echo $this->Html->link($this->Number->format($tag->note_count), ['controller' => 'Notes', 'action' => 'index', 'tag', h($tag->id)]) ?></td>
                <td><?php echo $this->Html->link($this->Number->format($tag->post_count), ['controller' => 'Posts', 'action' => 'index', 'tag', h($tag->id)]) ?></td>
                <td><?php echo $this->Html->link($this->Number->format($tag->project_count), ['controller' => 'Project', 'action' => 'index', 'tag', h($tag->id)]) ?></td>
                <td><?php echo $this->Number->format($tag->total_items) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
else:
    echo $this->element('layout/empty');
endif;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');

