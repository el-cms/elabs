<?php
$this->assign('title', __d('users', 'Authors'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?php echo $this->Paginator->sort('realname', __d('users', 'Real name')) ?></li>
	<li><?php echo $this->Paginator->sort('username', __d('users', 'User name')) ?></li>
	<li><?php echo $this->Paginator->sort('created', __d('users', 'Join date')) ?></li>
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
