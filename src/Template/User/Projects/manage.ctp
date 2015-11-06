<?php
$this->assign('title', __d('posts', 'Your projects'));

$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('name', __d('projects', 'Project name')) ?></li>
    <li><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?></li>
    <li><?php echo $this->Paginator->sort('modified', __d('elabs', 'Update date')) ?></li>
</ul>
<?php
$this->end();

$this->start('pageFiltersMenu');
$options = ['escape' => false];
$active = ['<span class="fa fa-fw fa-check-circle-o"></span>'];
$inactive = ['<span class="fa fa-fw fa-circle-o"></span>'];
$clear = ['<span class="fa fa-fw fa-times"></span>'];


echo $this->Html->link(__d('elabs', '{0}&nbsp;Clear filters', $clear), ['all', 'all'], $options);
?>
<hr/>
<ul>
    <li>
        <?php
        $icon = ($filterNSFW === 'all') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), ['all', $filterStatus], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterNSFW === 'safe') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only safe projects', $icon), ['safe', $filterStatus], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only unsafe projects', $icon), ['unsafe', $filterStatus], $options);
        ?>
    </li>
</ul>
<hr />
<ul>
    <li>
        <?php
        $icon = ($filterStatus === 'all') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), [$filterNSFW, 'all'], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterStatus === 'locked') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Only locked projects', $icon), [$filterNSFW, 'locked'], $options);
        ?>
    </li>
</ul>
<?php
$this->end();

$this->start('pageActionsMenu');
echo $this->Html->link(__d('projects', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'New project']), ['action' => 'add'],  ['class' => 'btn btn-green waves-attach waves-button waves-effect', 'escape' => false]);
$this->end();

$this->start('pageContent');
if (!$projects->isEmpty()):
    ?>

    <div class="tile-wrap" id="tiles-projects">
        <?php
        foreach ($projects as $project):
            echo $this->element('projects/tile_userindex', ['tileId' => 'tiles-projects', 'project' => $project]);
        endforeach;
        ?>
    </div>

    <?php
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
