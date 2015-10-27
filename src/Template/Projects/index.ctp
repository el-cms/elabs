<?php
$this->assign('title', __d('projects', 'Projects'));

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
	$item = [
			'fkid' => $project->id,
			'user' => $project['user'],
	];
	echo $this->element('projects/card', ['data' => $project, 'item' => $item]);

endforeach;

$this->end();

echo $this->element('layouts/defaultindex');
