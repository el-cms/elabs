<?php
use Cake\Core\Configure;

echo $this->Form->create('User', ['url' => ['plugin'=>'CakeDC/Users', 'prefix' => false, 'controller' => 'Users', 'action' => 'register'], 'idPrefix' => 'register']);

if (Configure::read('Users.Tos.required')) {
    echo $this->Form->input('tos', ['type' => 'checkbox', 'label' => __d('elabs', 'Accept these conditions?'), 'required' => true]);
}
echo $this->Form->input('username', ['label' => __d('elabs', 'User name'), 'required' => true, 'help' => __d('elabs', 'User name should be small caps, alphanumeric and underscores only')]);
echo $this->Form->input('email', ['label' => __d('elabs', 'E-mail'), 'required' => true, 'help' => __d('elabs', 'Your e-mail won\'t be given/sold to third-parties')]);
echo $this->Form->input('password', ['required' => true]);
echo $this->Form->input('password_confirm', ['label' => __d('elabs', 'Password confirmation'), 'type' => 'password', 'required' => true]);
echo $this->Form->input('first_name', ['label' => __d('elabs', 'First name')]);
echo $this->Form->input('last_name', ['label' => __d('elabs', 'Last name')]);
echo $this->Form->input('bio', ['label' => __d('elabs', 'About you'), 'type' => 'textarea', 'help' => __d('elabs', 'Tell us why you want to come here')]);

if (Configure::read('Users.reCaptcha.registration')) {
    echo $this->User->addReCaptcha();
}
echo $this->Form->submit(__d('elabs', 'Register'), ['class' => 'btn-block btn-primary']);
echo $this->Form->end();
