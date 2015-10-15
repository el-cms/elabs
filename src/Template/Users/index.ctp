<?php
$this->assign('title', __d('elabs', 'Authors'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?= $this->Paginator->sort('username') ?></li>
	<li><?= $this->Paginator->sort('realname') ?></li>
	<li><?= $this->Paginator->sort('created', __d('elabs', 'Join date')) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
?>
<div class="row">
	<?php
	foreach ($users as $user):
		echo $this->element('users/card', ['user' => $user]);
	endforeach;
	?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultindex');
