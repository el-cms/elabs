<?php
/*
 * File:
 *   src/Templates/Admin/Tags/index.ctp
 * Description:
 *   Administration - List of tags, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('elabs', 'List of tags'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Tags'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Order by:
$this->start('pageOrderBy');
echo $this->Paginator->sort('id', __d('elabs', 'Tag'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
foreach ($tags as $tag):
    ?>
    <div class="tag-item">
        <span class="tag-name"><?php echo h($tag->id) ?></span>
        <ul class="tag-counts">
            <li><?php echo $this->Html->iconT('book', $tag->album_count) ?></li>
            <li><?php echo $this->Html->iconT('file-o', $tag->file_count) ?></li>
            <li><?php echo $this->Html->iconT('sticky-note-o', $tag->note_count) ?></li>
            <li><?php echo $this->Html->iconT('font', $tag->post_count) ?></li>
            <li><?php echo $this->Html->iconT('cogs', $tag->project_count) ?></li>
        </ul>
        <?php echo $this->Form->postLink($this->Html->icon('times'), ['action' => 'delete', $tag->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $tag->id), 'class' => 'btn btn-danger btn-xs', 'escape' => false]) ?>
    </div>
    <?php
endforeach;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminindex');
