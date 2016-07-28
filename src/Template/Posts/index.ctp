<?php
/*
 * File:
 *   src/Templates/Posts/index.ctp
 * Description:
 *   List of posts, sortable and filterable
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Articles'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('title', __d('elabs', 'Title'));
echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date'));
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="row">
    <?php
    if (!$posts->isEmpty()):
        foreach ($posts as $post):
            echo $this->element('posts/card', ['data' => $post, 'event' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty');
    endif;
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
