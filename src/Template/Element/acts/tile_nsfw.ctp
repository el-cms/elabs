<?php
// Tile class
switch ($item->model):
    case 'Files':
        $icon = 'file-o';
        break;
    case 'Post':
        $icon = 'font';
        break;
    case 'Projects':
        $icon = 'cogs';
        break;
    default:
        $icon = 'question';
endswitch;
// Title link
?>
<div class="tile tile-red">
    <div class="pull-left tile-side">
        <i class="fa fa-<?php echo $icon ?>"></i>
    </div>
    <div class="tile-inner">
        <strong><?php echo __d('acts', 'This element may not be safe, therefore it is hidden.') ?></strong>
    </div>
</div>