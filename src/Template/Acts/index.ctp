<?php
$this->loadHelper('Items');
$this->loadHelper('License');

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
$this->start('pageFiltersMenu');
$options = ['escape' => false];
$active = ['<span class="fa fa-fw fa-check-circle-o"></span>'];
$inactive = ['<span class="fa fa-fw fa-circle-o"></span>'];
?>
<ul>
    <li>
        <?php
        echo $this->Html->link(__d('elabs', 'Clear filters'), ['action'=>'index'], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterUpdates === 'yes') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide updates', $icon), [$filterPosts, $filterProjects, $filterFiles, (($filterUpdates === 'yes') ? 'no' : 'yes')], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterPosts === 'yes') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide articles', $icon), [(($filterPosts === 'yes') ? 'no' : 'yes'), $filterProjects, $filterFiles, $filterUpdates], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterProjects === 'yes') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide projects', $icon), [$filterPosts, (($filterProjects === 'yes') ? 'no' : 'yes'), $filterFiles, $filterUpdates], $options);
        ?>
    </li>
    <li>
        <?php
        $icon = ($filterFiles === 'yes') ? $active : $inactive;
        echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide files', $icon), [$filterPosts, $filterProjects, (($filterFiles === 'yes') ? 'no' : 'yes'), $filterUpdates], $options);
        ?>
    </li>
</ul>
<?php
$this->end();
// Page content
$this->start('pageContent');
if (!$acts->isEmpty()):
    foreach ($acts as $act):
        // Check for valid action. If action is not on the list, it's ignored
        if (!$see_nsfw && !$items[$act['id']]['sfw']):
            echo $this->element('acts/tile_nsfw', ['item' => $act]);
        else:
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
        endif;
    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
