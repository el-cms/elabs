<?php
echo $this->Form->create('User', ['url' => ['prefix' => false, 'controller' => 'users', 'action' => 'login']]);
$this->Form->templates([
		'label' => '<label class="floating-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
]);
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->button(__('Login'), ['class' => 'btn-block']);
echo $this->Form->end();
?>
<div class="text-center"><?= __d('elabs', 'or') ?></div>
<?= $this->Html->link(__d('elabs', 'Register'), ['prefix' => false, 'controller' => 'users', 'action' => 'register'], ['class' => 'btn btn-flat btn-block']) ?>
