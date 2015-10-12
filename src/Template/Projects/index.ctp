<?php
$this->assign('title', __d('elabs', 'Articles'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?= $this->Paginator->sort('name') ?></li>
	<li><?= $this->Paginator->sort('created') ?></li>
	<li><?= $this->Paginator->sort('modified') ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
foreach ($projects as $project):
	$data = [
			'name' => $project->name,
			'short_description' => $project->short_description,
//			'sfw' => $project->sfw,
//			'download' => $project->download,
			'created' => $project->created,
			'modified' => $project->modified,
			'license' => $project->license,
	];
	$item = [
			'fkid' => $project->id,
			'user' => $project['user'],
	];
	echo $this->element('projects/card', ['data' => $data, 'item' => $item]);

endforeach;

$this->end();

echo $this->element('layouts/defaultindex');
