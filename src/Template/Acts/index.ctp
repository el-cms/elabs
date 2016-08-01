<?php
/*
 * File:
 *   src/Templates/Acts/index.ctp
 * Description:
 *   List of acts, sortable and filterable
 * Layout element:
 *   defaultindex.ctp
 */

// Additionnal helpers
$this->loadHelper('Items');
$this->loadHelper('License');
$this->loadHelper('Time', ['className' => 'ElabsTime']);

// Page title
$this->assign('title', __d('elabs', 'Recent activity'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Home'));

// Block: Pagination order links
// -----------------------------
$this->start('pageOrderBy');
echo $this->Paginator->sort('id', __d('elabs', 'Date'));
echo $this->Paginator->sort('model', __d('elabs', 'Type'));
echo $this->Paginator->sort('type', __d('elabs', 'Action'));
echo $this->Paginator->sort('user_id', __d('elabs', 'User'));
$this->end();

// Block: Filters
// --------------
$this->start('pageFilters');
$options = ['escape' => false];
$active = 'check-circle-o';
$inactive = 'circle-o';
$clear = 'times';
echo $this->Html->link($this->Html->iconT($clear, __d('elabs', 'Clear filters')), ['action' => 'index'], $options);
$icon = ($filterUpdates === 'yes') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Hide updates')), [$filterPosts, $filterProjects, $filterFiles, (($filterUpdates === 'yes') ? 'no' : 'yes')], $options);
$icon = ($filterPosts === 'yes') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Hide articles')), [(($filterPosts === 'yes') ? 'no' : 'yes'), $filterProjects, $filterFiles, $filterUpdates], $options);
$icon = ($filterProjects === 'yes') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Hide projects')), [$filterPosts, (($filterProjects === 'yes') ? 'no' : 'yes'), $filterFiles, $filterUpdates], $options);
$icon = ($filterFiles === 'yes') ? $active : $inactive;
echo $this->Html->link($this->Html->iconT($icon, __d('elabs', 'Hide files')), [$filterPosts, $filterProjects, (($filterFiles === 'yes') ? 'no' : 'yes'), $filterUpdates], $options);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
if (!$acts->isEmpty()):
    ?>
    <div class="timeline">
        <dl>
            <?php
            $lastDate = new Cake\I18n\Time();
            // Items
            foreach ($acts as $act):
                $actDate = $act->created;
                // Date change ?
                if (!$this->Time->isSameDay($lastDate, $actDate)):
                    ?>
                    <dt><?php echo $this->Time->format($actDate, "dd/MM/yyyy") ?></dt>
                    <?php
                endif;
                // Last date shift
                $lastDate = $actDate;
                $model = Cake\Utility\Inflector::variable(Cake\Utility\Inflector::singularize($act['model']));
                // Filter NSFW
                if (!is_null($act[$model])):
                    if ($act['type'] === 'add'):
                        ?>
                        <dd class="pos-right clearfix">
                            <div class="circ circ-success"></div>
                            <div class="time">
                                <?php echo $this->Time->format($actDate, "hh:mm") ?>
                            </div>
                            <div class="events event-success">
                                <?php echo $this->element(strtolower($act['model']) . '/card', ['data' => $act[$model], 'event' => 'true']); ?>
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
                                $class = 'trash';
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
                            <div class="circ circ-<?php echo $class ?>"></div>
                            <div class="time">
                                <?php echo $this->Time->format($actDate, "hh:mm") ?>
                            </div>
                            <div class="events event-<?php echo $class ?>">
                                <?php
                                // Text
                                $linkText = __dx('elabs', 'Act update card: [model] title [action]', '{0} {1} {2}', [$config['models'][$act['model']], $itemTitle, $config['strings'][$act['type']]]);
                                // Icon
                                $linkIcon = $this->Html->iconT($icon, $linkText);
                                // Final link
                                echo $this->Html->link($linkIcon, ['prefix' => false, 'controller' => $act['model'], 'action' => 'view', $act['fkid']], ['class' => 'full', 'escape' => false]);
                                ?>
                            </div>
                        </dd>
                    <?php
                    endif;

                else:
                    ?>
                    <dd class="pos-right clearfix">
                        <div class="circ circ-nsfw"></div>
                        <div class="events event-nsfw">
                            <?php echo $this->element('acts/tile_nsfw', ['model' => $act->model, 'event' => 'true']); ?>
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

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultindex');
