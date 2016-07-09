<?php
$this->loadHelper('Items');
$this->loadHelper('License');
$this->loadHelper('Time', ['className' => 'ElabsTime']);

$this->assign('title', __d('acts', 'Recent activity'));

// Pagination order links
$this->start('pageOrderMenu');
$linkOptions = ['class' => 'btn'];
echo $this->Paginator->sort('id', __d('elabs', 'Date'), $linkOptions);
echo $this->Paginator->sort('model', __d('elabs', 'Type'), $linkOptions);
echo $this->Paginator->sort('type', __d('elabs', 'Action'), $linkOptions);
echo $this->Paginator->sort('user_id', __d('elabs', 'User'), $linkOptions);
$this->end();
// Filters
$this->start('pageFiltersMenu');
$options = ['escape' => false];
$active = ['<span class="fa fa-fw fa-check-circle-o"></span>'];
$inactive = ['<span class="fa fa-fw fa-circle-o"></span>'];
echo $this->Html->link(__d('elabs', 'Clear filters'), ['action' => 'index'], $options);
$icon = ($filterUpdates === 'yes') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide updates', $icon), [$filterPosts, $filterProjects, $filterFiles, (($filterUpdates === 'yes') ? 'no' : 'yes')], $options);
$icon = ($filterPosts === 'yes') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide articles', $icon), [(($filterPosts === 'yes') ? 'no' : 'yes'), $filterProjects, $filterFiles, $filterUpdates], $options);
$icon = ($filterProjects === 'yes') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide projects', $icon), [$filterPosts, (($filterProjects === 'yes') ? 'no' : 'yes'), $filterFiles, $filterUpdates], $options);
$icon = ($filterFiles === 'yes') ? $active : $inactive;
echo $this->Html->link(__d('elabs', '{0}&nbsp;Hide files', $icon), [$filterPosts, $filterProjects, (($filterFiles === 'yes') ? 'no' : 'yes'), $filterUpdates], $options);
$this->end();
// Page content
$this->start('pageContent');
if (!$acts->isEmpty()):
    ?>
    <div class="timeline">
        <dl>
            <?php
            $lastDate = new Cake\I18n\Time();
            foreach ($acts as $act):
                $model = Cake\Utility\Inflector::variable(Cake\Utility\Inflector::singularize($act['model']));
                // Filter NSFW
                if (!is_null($act[$model])):
                    // Model name
                    // Act date
                    $actDate = $act[$model]->modified;
                    // Date change ?
                    if (!$this->Time->isSameDay($lastDate, $actDate)):
                        ?>
                        <dt><?= $this->Time->format($actDate, "dd/MM/yyyy") ?></dt>
                        <?php
                    endif;
                    if ($act['type'] === 'add'):
                        ?>
                        <dd class="pos-right clearfix">
                            <div class="circ"></div>
                            <div class="time">
                                <?= $this->Time->format($actDate, "hh:mm") ?>
                            </div>
                            <div class="events">
                                <?= $this->element(strtolower($act['model']) . '/card_small', ['data' => $act[$model], 'style' => 'small']); ?>
                            </div>
                        </dd>
                        <?php
                    else: // Info
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
                            case 'Projects':
                                $itemTitle = $act[$model]['name'];
                                break;
                            case 'Files':
                                $itemTitle = $act[$model]['name'];
                                break;
                            default:
                                $itemTitle = $act[$model]['id'];
                        endswitch;
                        ?>
                        <dd class="pos-left clearfix">
                            <div class="circ"></div>
                            <div class="time">
                                <?= $this->Time->format($actDate, "hh:mm") ?>
                            </div>
                            <div class="events">
                                <div class="tile tile-<?php echo $class ?>">
                                    <?php
                                    echo $this->Html->link(__('{0} {1} {2} {3}', [$this->Html->icon($icon), $config['models'][$act['model']], $itemTitle, $config['strings'][$act['type']]]), ['prefix' => false, 'controller' => $act['model'], 'action' => 'view', $act['fkid']], ['class' => 'full', 'escape' => false]);
                                    ?>
                                </div>
                            </div>
                        </dd>
                    <?php
                    endif;
                    // Last date shift
                    $lastDate = $actDate;
                else:
                    ?>
                    <dd class="pos-right clearfix">
                        <div class="circ circ-nsfw"></div>
                        <div class="events">
                            <?= $this->element('acts/tile_nsfw', ['model' => $act->model]); ?>
                        </div>
                    </dd>
                <?php
                endif;
            endforeach;
            ?>
        </dl>
    </div>
    <?php
else:
    echo $this->element('layout/empty');
endif;
$this->end();

echo $this->element('layouts/defaultindex');
