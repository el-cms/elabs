<?php
$this->assign('title', __d('posts', 'Articles'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?= $this->Paginator->sort('title') ?></li>
	<li><?= $this->Paginator->sort('publication_date') ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
foreach ($posts as $post):
	$data = [
			'title' => $post->title,
			'excerpt' => $post->excerpt,
			'sfw' => $post->sfw,
			'publication_date' => $post->publication_date,
			'modified' => $post->modified,
			'license' => $post['license'],
	];
	$item = [
			'fkid' => $post->id,
			'user' => $post['user'],
	];
	echo $this->element('posts/card', ['data' => $data, 'item' => $item]);
endforeach;
$this->end();

echo $this->element('layouts/defaultindex');
