<div class="tile tile-collapse">
    <div data-parent="#<?php echo $tileId ?>" data-target="#<?php echo $tileId . $file->id ?>" data-toggle="tile" class="padding-no">
        <div class="pull-right">
            <ul class="margin-no nav nav-list">
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle text-default waves-attach waves-effect" data-toggle="dropdown"><span class="icon">more_vert</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;View online', '<span class="fa fa-eye fa-fw"></span>'), ['prefix' => false, 'action' => 'view', $file->id], ['class' => 'waves-attach waves-effect', 'escape' => false]); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;Edit', '<span class="fa fa-pencil fa-fw"></span>'), ['action' => 'edit', $file->id], ['class' => 'waves-attach waves-effect', 'escape' => false]) ?>
                        </li>
                        <li>
                            <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;Delete', '<span class="fa fa-trash fa-fw text-red "></span>'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'waves-attach waves-effect', 'escape' => false]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="tile-inner cell-title">
            <?php if ($file->sfw): ?>
                <span class="label label-green fixed-font"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label label-red fixed-font"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>&nbsp;
            <?php if ($file->status === 2): ?>
                <span class="label label-red fixed-font"><?php echo __d('elabs', 'Locked') ?></span>
            <?php endif; ?>&nbsp;
            <?php echo h($file->name) ?>
        </div>
    </div>
    <div style="height: 0px;" class="tile-active-show collapse" id="<?php echo $tileId . $file->id ?>">
        <div class="tile-sub">
            <div class="row">
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt><?php echo __('Id') ?></dt>
                        <dd><?php echo $file->id ?></dd>
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
                <div class="col-sm-8">
                    <?php echo $this->element('files/view_content_' . $config['element'], ['data' => $file]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
