<div class="panel">
    <div class="panel-title">
        <!-- Item actions menu -->
        <div class="btn-group btn-panel-title">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->Html->icon('ellipsis-v') ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('eye', __d('elabs', 'View online')), ['prefix' => false, 'action' => 'view', $note->id], ['escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('pencil', __d('elabs', 'Edit')), ['action' => 'edit', $note->id], ['escape' => false]) ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink($this->Html->iconT('trash-o', __d('elabs', 'Delete'), ['class' => 'text-danger']), ['action' => 'delete', $note->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $note->id), 'escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- / Item actions menu -->

        <!-- Badges and title -->
        <span class="panel-group-title nocollapse">
            <?php if ($note->sfw): ?>
                <span class="label text-monospace label-success"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label text-monospace label-danger"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>
            <span class="label label-language"><?php echo $note->language->id; ?></span>
            <?php
            switch ($note->status):
                case STATUS_DRAFT:
                    ?><span class="label label-default"><?php echo __d('elabs', 'Draft') ?></span><?php
                    break;
                case STATUS_ACTIVE:
                    ?><span class="label label-success"><?php echo __d('elabs', 'Published') ?></span><?php
                    break;
                case STATUS_LOCKED:
                    ?><span class="label label-danger"><?php echo __d('elabs', 'Locked') ?></span><?php
                    break;
                case STATUS_DELETED:
                    ?><span class="label label-danger"><?php echo __d('elabs', 'Deleted') ?></span><?php
                    break;
                endswitch;
                ?>
        </span>
        <!-- / Badges and title -->
    </div>
    <div id="<?php echo $tileGroupId . $note->id ?>" class="panel-collapse in">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <dl>
                        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                        <dd><?php echo h($note->created) ?></dd>
                        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                        <dd><?php echo h($note->modified) ?></dd>
                        <dt><?php echo __d('elabs', 'License') ?></dt>
                        <dd><?php echo $this->Html->link(h($note->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $note->license_id]); ?></dd>
                        <dt><?php echo __d('elabs', 'Projects') ?></dt>
                        <dd>
                            <?php
                            $nbProj = count($note->projects);
                            if ($nbProj > 0):
                                echo $this->Html->arrayToString(array_map(function($project) {
                                            return $this->Html->Link($project->name, ['controller' => 'Projects', 'action' => 'view', $project->id]);
                                        }, $note->projects));
                            else:
                                echo __d('elabs', 'No projects');
                            endif;
                            ?>
                        </dd>
                        <dt><?php echo __d('elabs', 'Tags') ?></dt>
                        <dd>
                            <?php
                            if (count($note->tags) > 0):
                                echo $this->Html->arrayToString(array_map(function($tag) {
                                            return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                                        }, $note->tags));
                            else:
                                echo __d('elabs', 'No tags');
                            endif;
                            ?>
                        </dd>
                    </dl>
                </div>
                <div class="col-sm-8 rendered-text"<?php echo $this->Html->langAttr($note->language->iso639_1)?>>
                    <?php echo $this->Html->displayMD($note->text) ?>
                </div>
            </div>
        </div>
    </div>
</div>
