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
$this->assign('title', __d('posts', 'Your articles'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('title', __d('posts', 'Post title'));
echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date'));
echo $this->Paginator->sort('created', __d('elabs', 'Creation date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Update date'));
$this->end();

// Filters
// -------
$this->start('pageFilters');
$options = ['escape' => false];
$active = ['<span class="fa fa-fw fa-check-circle-o"></span>'];
$inactive = ['<span class="fa fa-fw fa-circle-o"></span>'];
$clear = ['<span class="fa fa-fw fa-times"></span>'];
$icon = ($filterNSFW === 'all') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), ['all', $filterPub], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Safe only', $icon), ['safe', $filterPub], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Unsafe only', $icon), ['unsafe', $filterPub], $options);
$icon = ($filterPub === 'all') ? $active : $inactive;
?>
<a class="btn-group-separator"></a>
<?php
echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), [$filterNSFW, 'all'], $options);
$icon = ($filterPub === 'published') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Pub. only', $icon), [$filterNSFW, 'published'], $options);
$icon = ($filterPub === 'drafts') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Drafts only', $icon), [$filterNSFW, 'drafts'], $options);
$icon = ($filterPub === 'locked') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Locked only', $icon), [$filterNSFW, 'locked'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link(__d('posts', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'New article']), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$posts->isEmpty()):
    $tileGroupId = 'tiles-posts-group';
    ?>
    <div class="panel-group" id="<?= $tileGroupId ?>" role="tablist" aria-multiselectable="true">
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
