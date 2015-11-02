<?php
$this->assign('title', __d('acts', 'Recent activity'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'waves-attach waves-effect'];
?>
<ul class="dropdown-menu nav">
    <li><?php echo $this->Paginator->sort('id', __d('elabs', 'Date'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('model', __d('elabs', 'Type'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('type', __d('elabs', 'Action'), $linkOptions) ?></li>
    <li><?php echo $this->Paginator->sort('user_id', __d('elabs', 'User'), $linkOptions) ?></li>
</ul>
<?php
$this->end();

// Page content
$this->start('pageContent');
if (!$acts->isEmpty()):
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
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
