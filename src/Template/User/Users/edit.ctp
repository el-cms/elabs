<nav class="tab-nav tab-nav-amber">
	<ul class="nav nav-justified">
		<li class="active">
			<a class="waves-attach waves-effect" data-toggle="tab" href="#tab-general" aria-expanded="true"><span class="fa fa-user"></span>&nbsp;<?= __d('elabs', 'Main informations') ?></a>
		</li>
		<li>
			<a class="waves-attach waves-effect" data-toggle="tab" href="#tab-password" aria-expanded="false"><span class="fa fa-lock"></span>&nbsp;<?= __d('elabs', 'Change password') ?></a>
		</li>
		<li>
			<a class="waves-attach waves-effect" data-toggle="tab" href="#tab-close" aria-expanded="false"><span class="fa fa-times text-red"></span>&nbsp;<?= __d('elabs', 'Close account') ?></a>
		</li>
	</ul>
	<div class="tab-nav-indicator" style="left: 303px; right: 289px;"></div>
</nav>
<div class="tab-content">
	<div class="tab-pane fade active in" id="tab-general">
		<?= $this->Form->create($user, ['class' => 'form']) ?>
		<?php
		echo $this->Form->input('email');
		echo '@' . $authUser['username'];
		echo $this->Form->input('realname');
		echo $this->Form->input('website', ['id' => 'website', 'inputGroup' => ['class'=>'Plop !'], 'label' => ['text' => 'Web site', 'class' => 'floating-label', 'for' => 'website']]);
		echo $this->Form->input('bio');
		echo $this->Form->input('see_nsfw');
		?>
		<?= $this->Form->button(__('Update')) ?>
		<?= $this->Form->end() ?>
	</div>
	<div class="tab-pane fade" id="tab-password">
		<?= $this->Form->create($user, ['action' => 'update_password']) ?>
		<?php
		echo $this->Form->input('current_password');
		echo $this->Form->input('password');
		echo $this->Form->input('password_verify');
		?>
		<?= $this->Form->button(__('Update')) ?>
		<?= $this->Form->end() ?>
	</div>
	<div class="tab-pane fade" id="tab-close">
		<?= $this->Form->create($user, ['action' => 'close_account']) ?>
		<?php
		echo $this->Form->input('current_password');
		?>
		<?= $this->Form->button(__d('elabs', 'Close my account'), ['class' => 'btn-red']) ?>
		<?= $this->Form->end() ?>
	</div>
</div>

