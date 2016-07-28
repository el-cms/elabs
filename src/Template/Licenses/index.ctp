<?php
/*
 * File:
 *   src/Templates/Licenses/index.ctp
 * Description:
 *   List of licenses, sortable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Licenses'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('elabs', 'Real name'));
echo $this->Paginator->sort('post_count', __d('elabs', 'Number of posts'));
echo $this->Paginator->sort('project_count', __d('elabs', 'Number of projects'));
echo $this->Paginator->sort('file_count', __d('elabs', 'Number of files'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    foreach ($licenses as $license):
        echo $this->element('licenses/card', ['license' => $license]);
    endforeach;
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
