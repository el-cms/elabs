<?php
$linkConfig = ['class' => 'waves-attach waves-effect', 'escape' => false];
?>
<nav aria-hidden="true" class="menu menu-right" id="profile" tabindex="-1" style="display: none;">
	<div class="menu-scroll">
		<div class="menu-top">
			<div class="menu-top-info">
				<div class="menu-top-user">
					<span class="avatar pull-left">
						<?php echo $this->Gravatar->generate($authUser['email']); ?>
					</span>&nbsp;<?= $authUser['username'] ?>
				</div>
			</div>
		</div>
		<div class="menu-content">
			<ul class="nav">
				<li>
					<?= $this->Html->link('<span class="fa fa-pencil fa-lg fa-fw"></span>&nbsp;' . __d('elabs', 'Update profile'), ['prefix' => 'user', 'controller' => 'users', 'action' => 'edit'], $linkConfig) ?>
				</li>
				<li>
					<?= $this->Html->link('<span class="fa fa-sign-out fa-lg fa-fw"></span>&nbsp;' . __d('elabs', 'Logout'), ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], $linkConfig) ?>
				</li>
				<li class="title">
					<?= __d('elabs', 'Articles:') ?>
				</li>
				<li><?= $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?= $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('elabs', 'Write something !'), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'add'], $linkConfig) ?></li>
				<li class="title">
					<?= __d('elabs', 'Projects:') ?>
				</li>
				<li><?= $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?= $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('elabs', 'Add a project !'), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'add'], $linkConfig) ?></li>
				<li class="title">
					<?= __d('elabs', 'Files:') ?>
				</li>
				<li><?= $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'files', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?= $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('elabs', 'Upload some rich content !'), ['prefix' => 'user', 'controller' => 'files', 'action' => 'add'], $linkConfig) ?></li>
			</ul>
		</div>
	</div>
</nav>