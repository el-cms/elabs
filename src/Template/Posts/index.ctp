<?php
$this->assign('title', __d('posts', 'Articles'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?php echo $this->Paginator->sort('title') ?></li>
	<li><?php echo $this->Paginator->sort('publication_date') ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if(!$posts->isEmpty()):
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
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
