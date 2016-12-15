<?php
/*
 * File:
 *   src/Templates/Languages/index.ctp
 * Description:
 *   List of languages, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Languages'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'About'), ['controller' => 'Pages', 'action' => 'display', 'about']);
$this->Html->addCrumb(__d('elabs', 'Languages'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'List of languages'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('elabs', 'Name'));
echo $this->Paginator->sort('post_count', __d('elabs', 'Number of posts'));
echo $this->Paginator->sort('project_count', __d('elabs', 'Number of projects'));
echo $this->Paginator->sort('file_count', __d('elabs', 'Number of files'));
$this->end();

// Block: Filters
// --------------
$this->start('pageFilters');
$options = ['escape' => false];
$active = 'check-circle-o';
$inactive = 'circle-o';
$icon = ($filter === 'all') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Show all')), [(($filter === 'all') ? '' : 'all')], $options);
$icon = ($filter != 'all') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Hide languages with no content')), [(($filter === 'hideEmpties') ? '' : 'hideEmpties')], $options);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    foreach ($languages as $language):
        echo $this->element('languages/card', ['language' => $language]);
    endforeach;
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
