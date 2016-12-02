<?php
/*
 * File:
 *   src/Templates/Users/Albums/index.ctp
 * Description:
 *   List of albums owned by the logged in user
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Your albums'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('elabs', 'Name'));
echo $this->Paginator->sort('created', __d('elabs', 'Addition date'));
echo $this->Paginator->sort('modified', __d('elabs', 'Modification date'));
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
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'All')), ['all'], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Safe only')), ['safe'], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Unsafe only')), ['unsafe'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Add an album')), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$albums->isEmpty()):
    $tileGroupId = 'tiles-albums-group';
    ?>
    <div class="panel-group" id="<?php echo $tileGroupId ?>" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($albums as $album):
            echo $this->element('albums/tile_userindex', ['tileGroupId' => $tileGroupId, 'album' => $album]);
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
