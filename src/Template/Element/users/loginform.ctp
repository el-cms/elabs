<?php
echo $this->Form->create('User', ['url' => ['plugin'=>null, 'prefix' => false, 'controller' => 'users', 'action' => 'login'], 'idPrefix' => 'login']);
echo $this->Form->input('email', ['label' => __d('elabs', 'E-mail')]);
echo $this->Form->input('password', ['label' => __d('elabs', 'Password')]);
echo $this->Form->submit(__d('elabs', 'Login'), ['class' => 'btn-block btn-primary']);
echo $this->Form->end();

if (Cake\Core\Configure::read('cms.isRegistrationOpen')):
    ?>
    <div class="text-center"><?php echo __d('elabs', 'or') ?></div>
    <?php
    echo $this->Html->link(__d('elabs', 'Register'), ['prefix' => false, 'controller' => 'users', 'action' => 'register'], ['class' => 'btn btn-block']);
else:
    ?>
    <div class="alert alert-warning"><?php echo __d('elabs', 'Registrations are closed for now... Come back later.') ?></div>
<?php
endif;
?>

