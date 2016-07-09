<?php
// Tile class
switch ($model):
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
?>
<div class="tile tile-nsfw">
    <?php echo __('{0}&nbsp;{1}', [$this->Html->icon($icon), __d('acts', 'This element may not be safe, therefore it is hidden.')]) ?>
</div>