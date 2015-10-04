<?= $this->Form->create('User', ['controller' => 'Users', 'action' => 'login']) ?>
<div class="form-group form-group-label">
	<label class="floating-label" for="email"><?= __('Email') ?></label>
	<?= $this->Form->input('email', ['id' => 'email', 'label' => false, 'inputGroup' => false]) ?>
</div>
<div class="form-group form-group-label">
	<label class="floating-label" for="password"><?= __('Password') ?></label>
	<?= $this->Form->input('password', ['id' => 'password', 'label' => false, 'inputGroup' => false]) ?>
</div>
<?= $this->Form->button(__('Login'), ['class' => 'btn-block']); ?>
<?= $this->Form->end(); ?>