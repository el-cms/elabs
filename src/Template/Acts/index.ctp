<?php
$this->assign('title', __d('acts', 'Recent activity'));

// Pagination order links
$this->start('pageOrderMenu');
?>
<ul class="dropdown-menu nav">
	<li><?= $this->Paginator->sort('id', 'Date', ['class' => 'waves-attach waves-effect']) ?></li>
	<li><?= $this->Paginator->sort('model', 'Type', ['class' => 'waves-attach waves-effect']) ?></li>
	<li><?= $this->Paginator->sort('type', 'Action', ['class' => 'waves-attach waves-effect']) ?></li>
	<li><?= $this->Paginator->sort('user_id', 'User', ['class' => 'waves-attach waves-effect']) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
foreach ($acts as $act):
	// Check for valid action. If action is not on the list, it's ignored
	if (in_array($act['type'], ['add', 'edit', 'delete'])) :
		switch ($act['type']):
			case 'add':
				$element = strtolower($act['model']) . '/card';
				break;
			default:
				$element = 'acts/tile';
				break;
		endswitch;
	endif;
	echo $this->element($element, ['data' => $items[$act['id']], 'config' => $config, 'item' => $act]);
endforeach;
$this->end();

echo $this->element('layouts/defaultindex');
