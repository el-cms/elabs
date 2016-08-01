<?php
/*
 * File:
 *   src/Templates/Users/Projects/index.ctp
 * Description:
 *   List of projects owned by the logged in user
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Your projects'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Projects'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('elabs', 'Project name'));
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
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'All')), ['all', $filterStatus], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Safe only')), ['safe', $filterStatus], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Unsafe only')), ['unsafe', $filterStatus], $options);
?>
<a class="btn-group-separator"></a>
<?php
$icon = ($filterStatus === 'all') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'All')), [$filterNSFW, 'all'], $options);
$icon = ($filterStatus === 'locked') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Locked only')), [$filterNSFW, 'locked'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'New project')), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$projects->isEmpty()):
    $tileGroupId = 'tiles-projects-group';
    ?>
    <div class="panel-group" id="<?php echo $tileGroupId ?>" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($projects as $project):
            echo $this->element('projects/tile_userindex', ['tileGroupId' => $tileGroupId, 'project' => $project]);
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
