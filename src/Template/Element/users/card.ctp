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
			<div class="text-center">
				<div class="card-action-btn">
					<?= $this->Html->link(__d('elabs', "{0}&nbsp;Articles", '<span class="fa fa-font"></span>'), ['controller' => 'posts', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect', 'escape'=>false]) ?>
					<?= $this->Html->link(__d('elabs', '{0}&nbsp;Projects', '<span class="fa fa-cogs"></span>'), ['controller' => 'projects', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect', 'escape'=>false]) ?>
					<?= $this->Html->link(__d('elabs', '{0}&nbsp;Files', '<span class="fa fa-file"></span>'), ['controller' => 'files', 'action' => 'index', 'filter' => 'user', $this->Number->format($user['id'])], ['class' => 'btn btn-flat waves-attach waves-effect', 'escape'=>false]) ?>
				</div>
			</div>
		</div>
	</div>
</div>
