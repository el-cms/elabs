<?= $this->Form->create('User', ['controller' => 'Users', 'action' => 'register']) ?>
<div class="form-group form-group-label form-group-brand">
	<label class="floating-label" for="email"><?= __('Email') ?></label>
	<?= $this->Form->input('email', ['id' => 'email', 'required', 'label' => false, 'inputGroup' => false]) ?>
	<span class="form-help form-help-msg text-brand">
		<?= __d('elabs', 'You will need this to login. It won\'t be sold, I promise.') ?>
		<span class="form-help-icon fa fa-info-circle"></span>&nbsp;
	</span>
</div>
<div class="form-group form-group-label form-group-brand">
	<label class="floating-label" for="username"><?= __('User Name') ?></label>
	<?= $this->Form->input('username', ['id' => 'username', 'required', 'label' => false, 'inputGroup' => false]) ?>
	<span class="form-help form-help-msg text-brand">
	<?= __d('elabs', 'The user name should be a pseudo or whatever you want with no spaces in it.') ?>
		<span class="form-help-icon fa fa-info-circle"></span>&nbsp;
	</span>
</div>
<div class="form-group form-group-label form-group-brand">
	<label class="floating-label" for="realname"><?= __('Your name') ?></label>
<?= $this->Form->input('realname', ['id' => 'realname', 'required', 'label' => false, 'inputGroup' => false]) ?>
	<span class="form-help form-help-msg text-brand">
	<?= __d('elabs', 'Your real name') ?>
		<span class="form-help-icon fa fa-info-circle"></span>&nbsp;
	</span>
</div>
<div class="form-group form-group-label form-group-brand">
	<label class="floating-label" for="password"><?= __('Password') ?></label>
<?= $this->Form->input('password', ['id' => 'password', 'required', 'label' => false, 'inputGroup' => false]) ?>
</div>
<div class="form-group form-group-label form-group-brand">
	<label class="floating-label" for="password_confirm"><?= __('Confirm your password') ?></label>
<?= $this->Form->input('password_confirm', ['type' => 'password', 'id' => 'password_confirm', 'required', 'label' => false, 'inputGroup' => false]) ?>
</div>
<div class="form-group form-group-label">
	<label class="floating-label" for="bio"><?= __('A little bit about yourself') ?></label>
<?= $this->Form->input('bio', ['type' => 'textarea', 'id' => 'bio', 'label' => false, 'inputGroup' => false]) ?>
	<span class="form-help form-help-msg">
	<?= __d('elabs', 'Why do you want to be on this site ?') ?>
		<span class="form-help-icon fa fa-info-circle"></span>&nbsp;
	</span>
</div>
<?= $this->Form->submit(__('Register'), ['class' => 'btn-block']) ?>
<?= $this->Form->end() ?>