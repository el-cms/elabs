<?php
$formTemplate = [
		'label' => '<label class="floating-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
		'submitContainer' => '{{content}}',
];
?>

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
		<div class="row">
			<div class="col-sm-4">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				</p>
				<p>
					Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. 
				</p>
			</div>
			<div class="col-sm-8">
				<?php
				echo $this->Form->create($user, ['class' => 'form']);
				$this->Form->templates($formTemplate);
				?>
				<fieldset>
					<?php
					echo $this->Form->input('email', ['label' => ['text' => 'E-Mail']]);
					echo $this->Form->input('realname', ['label' => ['text' => 'Real name']]);
					echo $this->Form->input('website', ['label' => ['text' => 'Web site']]);
					echo $this->Form->input('bio', ['label' => ['text' => 'About you']]);
					echo $this->Form->input('see_nsfw', ['class' => 'access_hide', 'label' => 'Show NSFW content']);
					?>
				</fieldset>
				<div class="form-group-btn">
					<?= $this->Form->submit(__('Save changes')) ?>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="tab-password">
		<div class="row">
			<div class="col-sm-4">
				<p>
					Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>
					Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.
				</p>
			</div>
			<div class="col-sm-8">
				<?php
				echo$this->Form->create($user, ['action' => 'update_password']);
				$this->Form->templates($formTemplate);
				echo $this->Form->input('current_password', ['type'=>'password']);
				echo $this->Form->input('password',['type'=>'password', 'value'=>'', 'label'=>__d('elabs', 'New password')]);
				echo $this->Form->input('password_confirm', ['type'=>'password', 'value'=>'']);
				?>
				<div class="form-group-btn">
					<?= $this->Form->button(__('Update')) ?>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="tab-close">
		<div class="row">
			<div class="col-sm-4">
				<p class="text-red">
					Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
				</p>
				<p>
					Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. 
				</p>
			</div>
			<div class="col-sm-8">
				<?php
				echo $this->Form->create($user, ['action' => 'close_account']);
				$this->Form->templates($formTemplate);
				echo $this->Form->input('current_password', ['type'=>'password']);
				?>
				<div class="form-group-btn">
					<?= $this->Form->button(__d('elabs', 'Close my account'), ['class' => 'btn-red']) ?>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>


