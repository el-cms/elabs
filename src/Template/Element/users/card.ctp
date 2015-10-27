<div class="col-sm-4 col-xs-6">
  <div class="card">
    <div class="card-main">
      <div class="card-header">
        <div class="card-header-side pull-left">
          <div class="avatar avatar-lg">
            <?php echo $this->Gravatar->generate($user['email']) ?>
          </div>
        </div>
        <div class="card-inner">
          <div>
            <?php echo $this->Html->link(h($user['realname']), ['action' => 'view', $user->id]) ?>
          </div>
          <em class="subtitle">@<?php echo h($user['username']) ?></em><br/>
          <em class="subtitle"><?php echo __d('elabs', 'Since {0}', [$user['created']]) ?></em>

        </div>
      </div>
      <div class="card-inner">
        <?php echo $this->Html->link(__d('users', "{0}&nbsp;{1} Articles", '<span class="fa fa-font"></span>', $user['post_count']), ['controller' => 'posts', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
        <?php echo $this->Html->link(__d('users', '{0}&nbsp;{1} Projects', '<span class="fa fa-cogs"></span>', $user['project_count']), ['controller' => 'projects', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
        <?php echo $this->Html->link(__d('users', '{0}&nbsp;{1} Files', '<span class="fa fa-file"></span>', $user['file_count']), ['controller' => 'files', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape' => false]) ?>
      </div>
    </div>
  </div>
</div>
