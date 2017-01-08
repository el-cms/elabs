<div class="panel">
    <div class="panel-title">
        <!-- Item actions menu -->
        <div class="btn-group btn-panel-title">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->Html->icon('ellipsis-v') ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('eye', __d('elabs', 'View online')), ['prefix' => false, 'action' => 'view', $project->id], ['escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link($this->Html->iconT('pencil', __d('elabs', 'Edit')), ['action' => 'edit', $project->id], ['escape' => false]) ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink($this->Html->iconT('trash-o', __d('elabs', 'Delete'), ['class' => 'text-danger']), ['action' => 'delete', $project->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $project->id), 'escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- / Item actions menu -->

        <!-- Badges and title -->
        <span class="panel-group-title" data-toggle="collapse" data-parent="#<?php echo $tileGroupId ?>" href="#<?php echo $tileGroupId . $project->id ?>" aria-expanded="true" aria-controls="<?php echo $tileGroupId . $project->id ?>">
            <?php if ($project->sfw): ?>
                <span class="label text-monospace label-success"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label text-monospace label-danger"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>
            <span class="label label-language"><?php echo $project->language->id; ?></span>
            <?php if ($project->status === STATUS_LOCKED): ?>
                <span class="label label-danger"><?php echo __d('elabs', 'Locked') ?></span>
            <?php endif; ?>&nbsp;
            <span id="h-<?php echo $tileGroupId . $project->id ?>"<?php echo $this->Html->langAttr($project->language->iso639_1) ?>><?php echo h($project->name) ?></span>
        </span>
        <!-- / Badges and title -->
    </div>
    <div id="<?php echo $tileGroupId . $project->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h-<?php echo $tileGroupId . $project->id ?>">
        <div class="panel-body">
            <dl>
                <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                <dd><?php echo h($project->created) ?></dd>
                <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                <dd><?php echo h($project->modified) ?></dd>
                <dt><?php echo __d('elabs', 'License') ?></dt>
                <dd><?php echo $this->Html->link(h($project->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $project->license_id]); ?></dd>
                <dt><?php echo __d('elabs', 'Tags') ?></dt>
                <dd>
                    <?php
                    if (count($project->tags) > 0):
                        echo $this->Html->arrayToString(array_map(function($tag) {
                                    return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                                }, $project->tags));
                    else:
                        echo __d('elabs', 'No tags');
                    endif;
                    ?>
                </dd>
            </dl>
        </div>
    </div>
</div>
