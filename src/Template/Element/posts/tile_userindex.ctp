<div class="panel">
    <div class="panel-title">
        <!-- Item actions menu -->
        <div class="btn-group btn-panel-title">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $this->Html->icon('ellipsis-v') ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;View online', $this->Html->icon('eye')), ['prefix' => false, 'action' => 'view', $post->id], ['class' => ' ', 'escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;Edit', $this->Html->icon('pencil')), ['action' => 'edit', $post->id], ['class' => ' ', 'escape' => false]) ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;Delete', $this->Html->icon('trash-o', ['class' => 'text-danger'])), ['action' => 'delete', $post->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $post->id), 'class' => ' ', 'escape' => false]) ?>
                </li>
            </ul>
        </div>
        <!-- / Item actions menu -->

        <!-- Badges and title -->
        <span class="panel-group-title"  data-toggle="collapse" data-parent="#<?php echo $tileGroupId ?>" href="#<?php echo $tileGroupId . $post->id ?>" aria-expanded="true" aria-controls="<?php echo $tileGroupId . $post->id ?>">
            <?php if ($post->sfw): ?>
                <span class="label text-monospace label-success"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label text-monospace label-danger"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>
            <span class="label label-language"><?php echo $post->language->id; ?></span>
            <?php if ($post->status === 1): ?>
                <span class="label label-success"><?php echo __d('elabs', 'Published') ?></span>
            <?php elseif ($post->status === 0): ?>
                <span class="label label-default"><?php echo __d('elabs', 'Draft') ?></span>
            <?php else: ?>
                <span class="label label-danger"><?php echo __d('elabs', 'Locked') ?></span>
            <?php endif; ?>&nbsp;
            <span id="h-<?php echo $tileGroupId . $post->id ?>" lang="<?php echo $post->language->iso639_1?>"><?php echo h($post->title) ?></span>
        </span>
        <!-- / Badges and title -->
    </div>
    <div id="<?php echo $tileGroupId . $post->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h-<?php echo $tileGroupId . $post->id ?>">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <dl>
                        <?php if ($post->published): ?>
                            <dt><?php echo __d('elabs', 'Publication date') ?></dt>
                            <dd><?php echo h($post->publication_date) ?></dd>
                        <?php endif; ?>
                        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                        <dd><?php echo h($post->created) ?></dd>
                        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                        <dd><?php echo h($post->modified) ?></dd>
                        <dt><?php echo __d('elabs', 'License') ?></dt>
                        <dd><?php echo $this->Html->link(h($post->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $post->license_id]); ?></dd>
                        <dt><?php echo __d('elabs', 'Tags') ?></dt>
                        <dd><?php echo $this->element('layout/dev_inline') ?></dd>
                    </dl>
                </div>
                <div class="col-sm-8 rendered-text" lang="<?php echo $post->language->iso639_1?>">
                    <?php echo $this->Html->displayMD($post->excerpt) ?>
                </div>
            </div>
        </div>
    </div>
</div>
