<div class="panel">
    <div class="panel-title">
        <!-- Item actions menu -->
        <div class="btn-group btn-panel-title">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->Html->icon('ellipsis-v') ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('eye', __d('elabs', 'View online')), ['prefix' => false, 'action' => 'view', $album->id], ['escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('pencil', __d('elabs', 'Edit')), ['action' => 'edit', $album->id], ['escape' => false]) ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink($this->Html->iconT('trash-o', __d('elabs', 'Delete'), ['class' => 'text-danger']), ['action' => 'delete', $album->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $album->id), 'escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- / Item actions menu -->

        <!-- Badges and title -->
        <span class="panel-group-title"  data-toggle="collapse" data-parent="#<?php echo $tileGroupId ?>" href="#<?php echo $tileGroupId . $album->id ?>" aria-expanded="true" aria-controls="<?php echo $tileGroupId . $album->id ?>">
            <?php if ($album->sfw): ?>
                <span class="label text-monospace label-success"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label text-monospace label-danger"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>
            <span class="label label-language"><?php echo $album->language->id; ?></span>
            &nbsp;
            <span id="h-<?php echo $tileGroupId . $album->id ?>"<?php echo $this->Html->langAttr($album->language->iso639_1) ?>><?php echo h($album->name) ?></span>
        </span>
        <!-- / Badges and title -->
    </div>
    <div id="<?php echo $tileGroupId . $album->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h-<?php echo $tileGroupId . $album->id ?>">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <dl>
                        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                        <dd><?php echo h($album->created) ?></dd>
                        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                        <dd><?php echo h($album->modified) ?></dd>
                        <dt><?php echo __d('elabs', 'Projects') ?></dt>
                        <dd>
                            <?php
                            $nbProj = count($album->projects);
                            if ($nbProj > 0):
                                echo $this->Html->arrayToString(array_map(function($project) {
                                            return $this->Html->Link($project->name, ['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $project->id]);
                                        }, $album->projects));
                            else:
                                echo __d('elabs', 'No projects');
                            endif;
                            ?>
                        </dd>
                        <dt><?php echo __d('elabs', 'Tags') ?></dt>
                        <dd>
                            <?php
                            if (count($album->tags) > 0):
                                echo $this->Html->arrayToString(array_map(function($tag) {
                                            return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                                        }, $album->tags));
                            else:
                                echo __d('elabs', 'No tags');
                            endif;
                            ?>
                        </dd>
                    </dl>
                </div>
                <div class="col-sm-8 rendered-text">
                    <div<?php echo $this->Html->langAttr($album->language->iso639_1) ?>>
                        <?php echo $this->Html->displayMD($album->description); ?>
                    </div>
                    <h3><?php echo __d('elabs', 'Files') ?></h3>
                    <?php
                    $nbFiles = count($album->files);
                    if ($nbFiles > 0):
                        ?>
                        <?php
                        echo $this->Html->arrayToString(array_map(function($file) {
                                    return $this->Html->Link($file->name, ['prefix' => false, 'controller' => 'Files', 'action' => 'view', $file->id]);
                                }, $album->files));
                    else:
                        echo __d('elabs', 'No files');
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
