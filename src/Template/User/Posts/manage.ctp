<?php
$this->assign('title', __d('posts', 'Your articles'));

$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
  <li><?php echo $this->Paginator->sort('title') ?></li>
  <li><?php echo $this->Paginator->sort('published', __d('elabs', 'Publication date')) ?></li>
  <li><?php echo $this->Paginator->sort('publication_date', __d('elabs', 'Publication date')) ?></li>
  <li><?php echo $this->Paginator->sort('created', __d('elabs', 'Creation date')) ?></li>
  <li><?php echo $this->Paginator->sort('modified', __d('elabs', 'Update date')) ?></li>
  <li><?php echo $this->Paginator->sort('sfw', __d('elabs', 'Safe flag')) ?></li>
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
