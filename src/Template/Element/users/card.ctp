<div class="col-sm-4">
	<div class="card">
		<div class="card-main">
			<div class="card-header">
				<div class="card-header-side pull-left">
					<div class="avatar">
						<?php echo $this->Gravatar->generate($user['email']) ?>
					</div>
				</div>
				<div class="card-inner">
					<span><?= $this->Html->link(h($user['realname']), ['action' => 'view', $user->id]) ?></span>
				</div>
			</div>
				<div class="card-inner">
					<?= $this->Html->link(__d('elabs', "{0}&nbsp;{1} Articles", '<span class="fa fa-font"></span>', $user['post_count']), ['controller' => 'posts', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape'=>false]) ?>
					<?= $this->Html->link(__d('elabs', '{0}&nbsp;{1} Projects', '<span class="fa fa-cogs"></span>', $user['project_count']), ['controller' => 'projects', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape'=>false]) ?>
					<?= $this->Html->link(__d('elabs', '{0}&nbsp;{1} Files', '<span class="fa fa-file"></span>', $user['file_count']), ['controller' => 'files', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect btn-block', 'escape'=>false]) ?>
				</div>
		</div>
	</div>
</div>
