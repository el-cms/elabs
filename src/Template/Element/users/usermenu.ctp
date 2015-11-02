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
					</span>&nbsp;<?php echo $authUser['username'] ?>
				</div>
			</div>
		</div>
		<div class="menu-content">
			<ul class="nav">
				<li>
					<?php echo $this->Html->link('<span class="fa fa-pencil fa-lg fa-fw"></span>&nbsp;' . __d('users', 'Update profile'), ['prefix' => 'user', 'controller' => 'users', 'action' => 'edit'], $linkConfig) ?>
				</li>
				<li>
					<?php echo $this->Html->link('<span class="fa fa-sign-out fa-lg fa-fw"></span>&nbsp;' . __d('users', 'Logout'), ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], $linkConfig) ?>
				</li>
				<li class="title">
					<?php echo __d('posts', 'Articles:') ?>
				</li>
				<li><?php echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('posts', 'Write something !'), ['prefix' => 'user', 'controller' => 'posts', 'action' => 'add'], $linkConfig) ?></li>
				<li class="title">
					<?php echo __d('projects', 'Projects:') ?>
				</li>
				<li><?php echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('projects', 'Add a project !'), ['prefix' => 'user', 'controller' => 'projects', 'action' => 'add'], $linkConfig) ?></li>
				<li class="title">
					<?php echo __d('files', 'Files:') ?>
				</li>
				<li><?php echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;' . __d('elabs', 'Manage'), ['prefix' => 'user', 'controller' => 'files', 'action' => 'manage'], $linkConfig) ?></li>
				<li><?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;' . __d('files', 'Upload some rich content !'), ['prefix' => 'user', 'controller' => 'files', 'action' => 'add'], $linkConfig) ?></li>
			</ul>
		</div>
	</div>
</nav>