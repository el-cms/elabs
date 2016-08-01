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

if (!$event):
    ?>
    <div class="tile tile-nsfw">
        <?php
    endif;
    echo $this->Html->iconT($icon, __d('elabs', 'This element may not be safe, therefore it is hidden.'));
    if (!$event):
        ?>
    </div>
    <?php

 endif;
