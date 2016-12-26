<?php
/*
 * File:
 *   src/Templates/elements/loginform.ctp
 */

use Cake\Core\Configure;

echo $this->Form->create('User', ['url' => ['plugin' => 'CakeDC/Users', 'prefix' => false, 'controller' => 'Users', 'action' => 'login'], 'idPrefix' => 'login']);
echo $this->Form->input('email', ['label' => __d('elabs', 'Email')]);
echo $this->Form->input('password', ['label' => __d('elabs', 'Password')]);
if (Configure::read('Users.reCaptcha.login')) {
    echo $this->User->addReCaptcha();
}
if (Configure::read('Users.RememberMe.active')) {
    echo $this->Form->input(Configure::read('Users.Key.Data.rememberMe'), [
        'type' => 'checkbox',
        'label' => __d('CakeDC/Users', 'Remember me'),
        'checked' => 'checked'
    ]);
}
echo implode(' ', $this->User->socialLoginList());
$registrationActive = Configure::read('Users.Registration.active');

if (Configure::read('Users.Email.required')) {
    echo $this->Html->link(__d('CakeDC/Users', 'Reset Password'), ['action' => 'requestResetPassword']);
}
echo $this->Form->submit(__d('elabs', 'Login'), ['class' => 'btn-block btn-primary']);
echo $this->Form->end();

if ($registrationActive) :
    ?>
    <div class="text-center"><?php echo __d('elabs', 'or') ?></div>
    <?php
    echo $this->Html->link(__d('CakeDC/Users', 'Register'), ['prefix'=>null, 'plugin'=>'CakeDC/Users', 'controller'=>'Users', 'action' => 'register'], ['class' => 'btn btn-block']);
else:
    ?>
    <div class="alert alert-warning margin-top-lg"><?php echo __d('elabs', 'Registrations are closed for now... Come back later.') ?></div>
<?php
endif;
?>

