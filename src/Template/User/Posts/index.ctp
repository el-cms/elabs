<?php
/*
 * File:
 *   src/Templates/Users/Posts/index.ctp
 * Description:
 *   List of posts created by the logged in user
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Your articles'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('title', __d('elabs', 'Title'));
echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date'));
echo $this->Paginator->sort('created', __d('elabs', 'Creation date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Update date'));
$this->end();

// Filters
// -------
$this->start('pageFilters');
$options = ['escape' => false];
$active = 'check-circle-o';
$inactive = 'circle-o';
echo $this->Html->link($this->Html->iconT('times', __d('elabs', 'Clear filters')), ['all', 'all'], $options);
?>
<a class="btn-group-separator"></a>
<?php
$icon = ($filterNSFW === 'all') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Show all')), ['all', $filterPub], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Safe only')), ['safe', $filterPub], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Unsafe only')), ['unsafe', $filterPub], $options);
$icon = ($filterPub === 'all') ? $active : $inactive;
?>
<a class="btn-group-separator"></a>
<?php
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Show all')), [$filterNSFW, 'all'], $options);
$icon = ($filterPub === 'published') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Pub. only')), [$filterNSFW, 'published'], $options);
$icon = ($filterPub === 'drafts') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Drafts only')), [$filterNSFW, 'drafts'], $options);
$icon = ($filterPub === 'locked') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Locked only')), [$filterNSFW, 'locked'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'New article')), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$posts->isEmpty()):
    $tileGroupId = 'tiles-posts-group';
    ?>
    <div class="panel-group" id="<?php echo $tileGroupId ?>" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($posts as $post):
            echo $this->element('posts/tile_userindex', ['tileGroupId' => $tileGroupId, 'post' => $post]);
        endforeach;
        ?>
    </div>
    <?php
else:
    echo $this->element('layout/empty');
endif;
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
