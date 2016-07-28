<?php
// Tile class
switch ($item['type']):
	case 'edit':
		$class = 'info';
		$icon = 'info-circle';
		break;
	case 'delete':
		$class = 'danger';
		$icon = 'times';
		break;
	default:
		$class = '';
		$icon = 'info-circle';
endswitch;

// Title link
$link = $this->Html->link($data['title'], ['prefix' => false, 'controller' => $item['model'], 'action' => 'view', $item['fkid']]);
?>
<div class="tile tile-<?php echo $class ?>">
	<div class="pull-left tile-side">
		<?php echo $this->Html->icon($icon) ?>
	</div>
	<div class="tile-inner">
		<strong><?php echo $data['modified'] ?>: </strong><?php echo __d('elabs', '{0} {1} {2}', [$config['models'][$item['model']], $link, $config['strings'][$item['type']]]) ?>
	</div>
</div>