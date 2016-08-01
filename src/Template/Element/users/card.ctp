<div class="col-sm-4 col-xs-6">
    <div class="card card-user">
        <div class="card-heading">
            <div class="card-heading-side">
                <?php echo $this->Gravatar->generate($user['email'], ['image-options' => ['class' => 'img-rounded']]) ?>
            </div>
            <!-- Header -->
            <div class="card-header">
                <!-- Title -->
                <h3><?php echo $this->Html->link(h($user['realname']), ['action' => 'view', $user->id]) ?></h3>
                <ul class="card-informations">
                    <li class="subtitle">@<?php echo h($user['username']) ?></li>
                    <li class="subtitle"><?php echo __d('elabs', 'Since {0}', [$user['created']]) ?></li>
                </ul>

            </div>
        </div>
        <div class="card-content">
            <?php
            $linkTitle = $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $user['post_count'], $user['post_count']));
            echo $this->Html->link($linkTitle, ['controller' => 'posts', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            $linkTitle = $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $user['projects_count'], $user['project_count']));
            echo $this->Html->link($linkTitle, ['controller' => 'projects', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            $linkTitle = $this->Html->iconT('file', __dn('elabs', '{0} file', '{0} files', $user['file_count'], $user['file_count']));
            echo $this->Html->link($linkTitle, ['controller' => 'files', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            ?>
        </div>
    </div>
</div>
