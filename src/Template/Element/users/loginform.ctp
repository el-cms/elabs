<?php
echo $this->Form->create('User', ['url' => ['prefix' => null, 'controller' => 'users', 'action' => 'login']]);
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->button(__('Login'), ['class' => 'btn-block']);
echo $this->Form->end();
?>
<div class="text-center"><?= __d('elabs', 'or') ?></div>
<?= $this->Html->link(__d('elabs', 'Register'), ['prefix' => false, 'controller' => 'users', 'action' => 'register'], ['class'=>'btn btn-flat btn-block']) ?>
