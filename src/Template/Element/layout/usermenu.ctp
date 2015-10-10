<nav aria-hidden="true" class="menu menu-right" id="profile" tabindex="-1" style="display: none;">
	<div class="menu-scroll">
		<div class="menu-top">
			<div class="menu-top-info">
				<span class="fa fa-user fa-3x"></span>&nbsp;<?= $authUser['username'] ?>
			</div>
		</div>
		<div class="menu-content">
			<ul class="nav">
				<li>
					<?= $this->Html->link('<span class="fa fa-pencil fa-lg fa-fw"></span>&nbsp;' . __d('elabs', 'Update profile'), ['prefix' => 'user', 'controller' => 'users', 'action' => 'edit'], ['class' => 'waves-attach waves-effect', 'escape' => false]) ?>
				</li>
				<li>
					<?= $this->Html->link('<span class="fa fa-sign-out fa-lg fa-fw"></span>&nbsp;' . __d('elabs', 'Logout'), ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], ['class' => 'waves-attach waves-effect', 'escape' => false]) ?>
				</li>
			</ul>
		</div>
	</div>
</nav>