<?php
$this->assign('title', __d('elabs', 'Your posts'));

$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
  <li><?= $this->Paginator->sort('title') ?></li>
  <li><?= $this->Paginator->sort('published') ?></li>
  <li><?= $this->Paginator->sort('publication_date', __d('elabs','Publication date')) ?></li>
  <li><?= $this->Paginator->sort('created') ?></li>
  <li><?= $this->Paginator->sort('modified') ?></li>
  <li><?= $this->Paginator->sort('sfw') ?></li>
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
?>