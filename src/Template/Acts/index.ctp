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
        echo $this->Html->link(__d('elabs', 'Clear filters'), ['action' => 'index'], $options);
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
        $model = Cake\Utility\Inflector::variable(Cake\Utility\Inflector::singularize($act['model']));
        if (!$act[$model]['sfw'] && !$see_nsfw):
            echo $this->element('acts/tile_nsfw', ['model' => $act->model]);
        else:
            if ($act['type'] === 'add'):
                echo $this->element(strtolower($act['model']) . '/card', ['data' => $act[$model]]); //$items[$act['id']], 'config' => $config, 'item' => $act]);
            else:
                // Tile class
                switch ($act['type']):
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

                switch ($act['model']):
                    case 'Posts':
                        $itemTitle = $act[$model]['title'];
                        break;
                    case 'Project':
                        $itemTitle = $act[$model]['name'];
                        break;
                    case'File':
                        $itemTitle = $act[$model]['name'];
                        break;
                    default:
                        $itemTitle = $act[$model]['id'];
                endswitch;

                // Title link
                $link = $this->Html->link($itemTitle, ['prefix' => false, 'controller' => $act['model'], 'action' => 'view', $act['fkid']]);
                ?>
                <div class="tile tile-<?php echo $class ?>">
                    <div class="pull-left tile-side">
                        <i class="fa fa-<?php echo $icon ?>"></i>
                    </div>
                    <div class="tile-inner">
                        <strong><?php echo $act[$model]['modified'] ?>: </strong><?php echo __d('acts', '{0} {1} {2}', [$config['models'][$act['model']], $link, $config['strings'][$act['type']]]) ?>
                    </div>
                </div>
            <?php
            endif;
        endif;

    endforeach;
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
