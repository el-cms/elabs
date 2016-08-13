<?php
/*
 * File:
 *   src/Templates/Users/Notes/index.ctp
 * Description:
 *   List of notes created by the logged in user
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Your notes'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
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
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Show all')), ['all', $filterStatus], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Safe only')), ['safe', $filterStatus], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Unsafe only')), ['unsafe', $filterStatus], $options);
$icon = ($filterStatus === 'all') ? $active : $inactive;
?>
<a class="btn-group-separator"></a>
<?php
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Show all')), [$filterNSFW, 'all'], $options);
$icon = ($filterStatus === 'locked') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Locked only')), [$filterNSFW, 'locked'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'New note')), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$notes->isEmpty()):
    $tileGroupId = 'tiles-notes-group';
    ?>
    <div class="panel-group" id="<?php echo $tileGroupId ?>" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($notes as $note):
            echo $this->element('notes/tile_userindex', ['tileGroupId' => $tileGroupId, 'note' => $note]);
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
