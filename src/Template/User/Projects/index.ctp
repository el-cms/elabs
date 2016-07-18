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
$this->assign('title', __d('projects', 'Your projects'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('name', __d('projects', 'Project name'));
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
echo $this->Html->link(__d('elabs', '{0}&nbsp;Clear filters', $clear), ['all', 'all'], $options);
$icon = ($filterNSFW === 'all') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;All', $icon), ['all', $filterStatus], $options);
$icon = ($filterNSFW === 'safe') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Safe only', $icon), ['safe', $filterStatus], $options);
$icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Unsafe only', $icon), ['unsafe', $filterStatus], $options);
?>
<a class="btn-group-separator"></a>
<?php
$icon = ($filterStatus === 'all') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), [$filterNSFW, 'all'], $options);
$icon = ($filterStatus === 'locked') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Locked only', $icon), [$filterNSFW, 'locked'], $options);
$this->end();

// Page actions
// ------------
$this->start('pageActions');
echo $this->Html->link(__d('projects', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'New project']), ['action' => 'add'], ['class' => 'btn btn-block', 'escape' => false]);
$this->end();

// Page content
// ------------
$this->start('pageContent');
if (!$projects->isEmpty()):
    $tileGroupId = 'tiles-projects-group';
    ?>
    <div class="panel-group" id="<?= $tileGroupId ?>" role="tablist" aria-multiselectable="true">
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
