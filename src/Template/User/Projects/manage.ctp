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
?>
<ul>
  <li>
    <?php
    $icon = ($filterNSFW === 'all') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), ['all'], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterNSFW === 'safe') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only safe articles', $icon), ['safe'], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only unsafe artices', $icon), ['unsafe'], $options);
    ?>
  </li>
</ul>

<?php
$this->end();

$this->start('pageActionsMenu');
echo $this->Html->link(__('New Project'), ['action' => 'add'], ['class' => 'btn']);
$this->end();

$this->start('pageContent');
?>

<div class="tile-wrap" id="tiles-projects">
  <?php
  foreach ($projects as $project):
      echo $this->element('projects/tile_userindex', ['tileId' => 'tiles-projects', 'project' => $project]);
  endforeach;
  ?>
</div>

<?php

$this->end();

echo $this->element('layouts/defaultindex');
