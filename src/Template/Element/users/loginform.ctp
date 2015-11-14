<?php
echo $this->Form->create('User', ['url' => ['prefix' => false, 'controller' => 'users', 'action' => 'login']]);
$this->Form->templates([
    'label' => '<label class="floating-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
]);
echo $this->Form->input('email', ['label' => __d('elabs', 'E-mail')]);
echo $this->Form->input('password', ['label' => __d('elabs', 'Password')]);
echo $this->Form->submit(__d('elabs', 'Login'), ['class' => 'btn-block btn-green']);
echo $this->Form->end();

if (Cake\Core\Configure::read('cms.isRegistrationOpen')):
    ?>
    <div class="text-center"><?php echo __d('elabs', 'or') ?></div>
    <?php
    echo $this->Html->link(__d('users', 'Register'), ['prefix' => false, 'controller' => 'users', 'action' => 'register'], ['class' => 'btn btn-flat btn-block']);
else:
    ?>
    <div class="alert alert-warning"><?php echo __d('elabs', 'Registrations are closed for now... Come back later.') ?></div>
        <?php
endif;
