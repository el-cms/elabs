<div class="col-sm-4 col-xs-6">
    <div class="card">
        <div class="card-main">
            <div class="card-heading">
                <div class="card-header">
                    <!-- Title -->
                    <h3>
                      <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon($license->icon), h($license['name'])]), ['action' => 'view', $license->id], ['escape' => false]) ?>
                    </h3>
                </div>
            </div>
            <div class="card-content">
                <?php
                echo $this->Html->link(__d('licenses', "{0}&nbsp;{1} Articles", $this->Html->icon('font'), $license['post_count']), ['controller' => 'posts', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-block', 'escape' => false]);
                echo $this->Html->link(__d('licenses', '{0}&nbsp;{1} Projects', $this->Html->icon('cogs'), $license['project_count']), ['controller' => 'projects', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-block', 'escape' => false]);
                echo $this->Html->link(__d('licenses', '{0}&nbsp;{1} Files', $this->Html->icon('file'), $license['file_count']), ['controller' => 'files', 'action' => 'index', 'filter' => 'license', $license['id']], ['class' => 'btn btn-block', 'escape' => false]);
                ?>
            </div>
        </div>
    </div>
</div>
