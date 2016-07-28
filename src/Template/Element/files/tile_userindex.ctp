<div class="panel">
    <div class="panel-title">
        <!-- Item actions menu -->
        <div class="btn-group btn-panel-title">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->Html->icon('ellipsis-v') ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;View online', $this->Html->icon('eye')), ['prefix' => false, 'action' => 'view', $file->id], ['class' => ' ', 'escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;Edit', $this->Html->icon('pencil')), ['action' => 'edit', $file->id], ['class' => ' ', 'escape' => false]) ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;Delete', $this->Html->icon('trash-o', ['class' => 'text-danger'])), ['action' => 'delete', $file->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $file->id), 'escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- / Item actions menu -->

        <!-- Badges and title -->
        <span class="panel-group-title" data-toggle="collapse" data-parent="#<?php echo $tileGroupId ?>" href="#<?php echo $tileGroupId . $file->id ?>" aria-expanded="true" aria-controls="<?php echo $tileGroupId . $file->id ?>">
            <?php if ($file->sfw): ?>
                <span class="label text-monospace label-success"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label text-monospace label-danger"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>
            <?php echo $this->Html->langLabel($file->language->id, $file->language->iso639_1) ?>
            <?php if ($file->status === 2): ?>
                <span class="label label-danger"><?php echo __d('elabs', 'Locked') ?></span>
            <?php endif; ?>&nbsp;
            <span id="h-<?php echo $tileGroupId . $file->id ?>"><?php echo h($file->name) ?></span>
        </span>
        <!-- / Badges and title -->
    </div>
    <div id="<?php echo $tileGroupId . $file->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h-<?php echo $tileGroupId . $file->id ?>">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <dl>
                        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                        <dd><?php echo h($file->created) ?></dd>
                        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                        <dd><?php echo h($file->modified) ?></dd>
                        <dt><?php echo __d('elabs', 'License') ?></dt>
                        <dd><?php echo $this->Html->link(h($file->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $file->license_id]); ?></dd>
                        <dt><?php echo __d('elabs', 'Tags') ?></dt>
                        <dd><?php echo $this->element('layout/dev_inline') ?></dd>
                    </dl>
                </div>
                <div class="col-sm-8"  lang="<?php echo $file->language->iso639_1 ?>">
                    <?php echo $this->element('files/view_content_' . $config['element'], ['data' => $file]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
