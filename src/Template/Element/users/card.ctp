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
            echo $this->Html->link(__d('users', "{0}&nbsp;{1} Articles", $this->Html->icon('font'), $user['post_count']), ['controller' => 'posts', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            echo $this->Html->link(__d('users', '{0}&nbsp;{1} Projects', $this->Html->icon('cogs'), $user['project_count']), ['controller' => 'projects', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            echo $this->Html->link(__d('users', '{0}&nbsp;{1} Files', $this->Html->icon('file'), $user['file_count']), ['controller' => 'files', 'action' => 'index', 'filter' => 'user', $user['id']], ['class' => 'btn btn-block', 'escape' => false]);
            ?>
        </div>
    </div>
</div>
