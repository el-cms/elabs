<?php
$this->assign('title', __d('posts', 'Your articles'));

$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
  <li><?php echo $this->Paginator->sort('title', __d('posts', 'Post title')) ?></li>
  <li><?php echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date')) ?></li>
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
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), ['all', $filterPub], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterNSFW === 'safe') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only safe articles', $icon), ['safe', $filterPub], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterNSFW === 'unsafe') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only unsafe artices', $icon), ['unsafe', $filterPub], $options);
    ?>
  </li>
</ul>

<hr>

<ul>
  <li>
    <?php
    $icon = ($filterPub === 'all') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Show all', $icon), [$filterNSFW, 'all'], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterPub === 'published') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only published articles', $icon), [$filterNSFW, 'published'], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterPub === 'drafts') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only drafts', $icon), [$filterNSFW, 'drafts'], $options);
    ?>
  </li>
  <li>
    <?php
    $icon = ($filterPub === 'locked') ? $active : $inactive;
    echo $this->Html->link(__d('elabs', '{0}&nbsp;Only drafts', $icon), [$filterNSFW, 'locked'], $options);
    ?>
  </li>
</ul>

<?php
$this->end();

$this->start('pageActionsMenu');
echo $this->Html->link(__('New Post'), ['action' => 'add'], ['class' => 'btn']);
$this->end();

$this->start('pageContent');
?>

<div class="tile-wrap" id="tiles-posts">
  <?php
  foreach ($posts as $post):
      echo $this->element('posts/tile_userindex', ['tileId' => 'tiles-posts', 'post' => $post]);
  endforeach;
  ?>		
</div>
<?php
$this->end();

echo $this->element('layouts/defaultindex');
