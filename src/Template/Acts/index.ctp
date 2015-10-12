<?php
$this->assign('title', __d('elabs', 'Recent activity'));
?>

<div class="col-sm-3">
	<div class="dropdown-wrap">
		<div class="dropdown  dropdown-inline">
			<a aria-expanded="false" class="btn dropdown-toggle-btn waves-attach waves-effect" data-toggle="dropdown"><?= __d('elabs', 'Order by...') ?><span class="icon margin-left-sm">keyboard_arrow_down</span></a>
			<ul class="dropdown-menu nav">
				<li><?= $this->Paginator->sort('id', 'Date', ['class' => 'waves-attach waves-effect']) ?></li>
				<li><?= $this->Paginator->sort('model', 'Type', ['class' => 'waves-attach waves-effect']) ?></li>
				<li><?= $this->Paginator->sort('type', 'Action', ['class' => 'waves-attach waves-effect']) ?></li>
				<li><?= $this->Paginator->sort('user_id', 'User', ['class' => 'waves-attach waves-effect']) ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="col-sm-9">
	<?php
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
	?>
	<div class="paginator">
		<p class='pull-right'><?= $this->Paginator->counter() ?></p>
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
		</ul>
	</div>
</div>
