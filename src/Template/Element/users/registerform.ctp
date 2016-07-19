<?php

echo $this->Form->create('User', ['url' => ['plugin'=>null, 'prefix' => false, 'controller' => 'Users', 'action' => 'register'], 'idPrefix' => 'register']);
echo $this->Form->input('email', ['label' => __d('elabs', 'E-Mail'), 'required' => true, 'help' => __d('users', 'Your email won\'t be given/sold to third-parties')]);
echo $this->Form->input('username', ['label' => __d('users', 'User name'), 'required' => true, 'help' => __d('users', 'User name should be small caps, alphanumeric and underscores only')]);
echo $this->Form->input('realname', ['label' => __d('users', 'Real name'), 'required' => true, 'help' => __d('users', 'Your real name, if you don\'t mind')]);
echo $this->Form->input('password', ['required' => true, 'help' => __d('users', 'A strong password is a good start.')]);
echo $this->Form->input('password_confirm', ['label' => __d('users', 'Password confirmation'), 'type' => 'password', 'required' => true, 'help' => __d('users', 'Verify you didn\'t made a typo')]);
echo $this->Form->input('bio', ['label' => __d('elabs', 'About...'), 'type' => 'textarea', 'help' => __d('users', 'Tell us why you want to come here')]);
echo $this->Form->submit(__d('elabs', 'Register'), ['class' => 'btn-block btn-primary']);
echo $this->Form->end();
