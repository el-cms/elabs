<div class="col-sm-4 col-xs-6">
    <div class="card">
        <div class="card-main">
            <div class="card-header">
                <div class="card-header-side pull-left">
                    <span class="fa fa-<?php echo h($license->icon) ?>"></span>
                </div>
                <div class="card-inner">
                    <?php echo $this->Html->link(h($license['name']), ['action' => 'view', $license->id]) ?>
                </div>
            </div>
            <div class="card-inner">
                <?php echo $this->Html->link(__d('licenses', "{0}&nbsp;{1} Articles", '<span class="fa fa-font"></span>', $license['post_count']), ['controller' => 'posts', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
                <?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1} Projects', '<span class="fa fa-cogs"></span>', $license['project_count']), ['controller' => 'projects', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
                <?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1} Files', '<span class="fa fa-file"></span>', $license['file_count']), ['controller' => 'files', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</div>
