<div class="tile tile-collapse">
    <div data-parent="#<?php echo $tileId ?>" data-target="#<?php echo $tileId . $project->id ?>" data-toggle="tile" class="padding-no">
        <div class="pull-right">
            <ul class="margin-no nav nav-list">
                <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle text-default waves-attach waves-effect" data-toggle="dropdown"><span class="icon">more_vert</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;View online', '<span class="fa fa-eye fa-fw"></span>'), ['prefix' => false, 'action' => 'view', $project->id], ['class' => 'waves-attach waves-effect', 'escape' => false]); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;Edit', '<span class="fa fa-pencil fa-fw"></span>'), ['action' => 'edit', $project->id], ['class' => 'waves-attach waves-effect', 'escape' => false]) ?>
                        </li>
                        <li>
                            <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;Delete', '<span class="fa fa-trash fa-fw text-red "></span>'), ['action' => 'delete', $project->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $project->id), 'class' => 'waves-attach waves-effect', 'escape' => false]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="tile-inner cell-title">
            <?php if ($project->sfw): ?>
                <span class="label label-green fixed-font"><?php echo __d('elabs', 'Safe') ?></span>
            <?php else: ?>
                <span class="label label-red fixed-font"><?php echo __d('elabs', 'NSFW') ?></span>
            <?php endif; ?>&nbsp;
            <?php if ($project->status === 2): ?>
                <span class="label label-red fixed-font"><?php echo __d('elabs', 'Locked') ?></span>
            <?php endif; ?>&nbsp;
            <?php echo h($project->name) ?>
        </div>
    </div>
    <div style="height: 0px;" class="tile-active-show collapse" id="<?php echo $tileId . $project->id ?>">
        <div class="tile-sub">
            <div class="row">
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt><?php echo __d('elabs', 'Creation date') ?></dt>
                        <dd><?php echo h($project->created) ?></dd>
                        <dt><?php echo __d('elabs', 'Updated on') ?></dt>
                        <dd><?php echo h($project->modified) ?></dd>
                        <dt><?php echo __d('elabs', 'License') ?></dt>
                        <dd><?php echo $this->Html->link(h($project->license->name), ['prefix' => false, 'controller' => 'licenses', 'action' => 'view', $project->license_id]); ?></dd>
                        <dt><?php echo __d('elabs', 'Tags') ?></dt>
                        <dd><?php echo $this->element('layout/dev_inline') ?></dd>
                    </dl>
                </div>
                <div class="col-sm-8">
                    <div class="content-sub-heading"><?php echo __d('projects', 'Team') ?></div>
                    <?php echo $this->element('layout/dev_block') ?>
                </div>
            </div>
        </div>
    </div>
</div>
