<div class="col-sm-4 col-xs-6">
    <div class="card">
        <div class="card-main">
            <div class="card-heading">
                <div class="card-header">
                    <!-- Title -->
                    <h3>
                        <?php echo $this->Html->link($this->Html->iconT($license->icon, h($license['name'])), ['action' => 'view', $license->id], ['escape' => false]) ?>
                    </h3>
                </div>
            </div>
            <div class="card-content">
                <?php
                $linkTitle = $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $license->post_count, $license->post_count));
                echo $this->Html->link($linkTitle, ['controller' => 'Posts', 'action' => 'index', 'license', $license->id], ['class' => 'btn btn-block', 'escape' => false]);
                $linkTitle = $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $license->project_count, $license->project_count));
                echo $this->Html->link($linkTitle, ['controller' => 'Projects', 'action' => 'index', 'license', $license->id], ['class' => 'btn btn-block', 'escape' => false]);
                $linkTitle = $this->Html->iconT('file', __dn('elabs', '{0} file', '{0} files', $license->file_count, $license->file_count));
                echo $this->Html->link($linkTitle, ['controller' => 'Files', 'action' => 'index', 'license', $license->id], ['class' => 'btn btn-block', 'escape' => false]);
                ?>
            </div>
        </div>
    </div>
</div>
