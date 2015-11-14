<?php

echo $this->Form->create('User', ['prefix' => false, 'controller' => 'Users', 'action' => 'register']);
$this->Form->templates([
    'label' => '<label class="floating-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'inputContainer' => '<div class="form-group form-group-label form-group-brand {{required}}">{{content}}'
    . '<span class="form-help form-help-msg">{{help}}'
    . '<span class="fa fa-info form-help-icon"></span>'
    . '</span></div>',
    'inputContainerError' => '<div class="form-group form-group-label form-group-red{{required}}">{{content}}'
    . '<span class="form-help form-help-msg">{{help}}x'
    . '<span class="fa fa-info form-help-icon"></span>'
    . '</span></div>'
    . '<span class="form-help form-help-msg text-red">{{error}}'
    . '<span class="fa fa-warning-sign form-help-icon"></span>'
    . '</span></div>',
]);
echo $this->Form->input('email', ['label' => __d('elabs', 'E-Mail'), 'required', 'templateVars' => ['help' => __d('users', 'Your email won\'t be given/sold to third-parties')]]);
echo $this->Form->input('username', ['label' => __d('users', 'User name'), 'required', 'templateVars' => ['help' => __d('users', 'User name should be small caps, alphanumeric and underscores only')]]);
echo $this->Form->input('realname', ['label' => __d('users', 'Real name'), 'required', 'templateVars' => ['help' => __d('users', 'Your real name, if you don\'t mind')]]);
echo $this->Form->input('password', ['required', 'templateVars' => ['help' => __d('users', 'A strong password is a good start.')]]);
echo $this->Form->input('password_confirm', ['label' => __d('users', 'Password confirmation'), 'type' => 'password', 'required', 'templateVars' => ['help' => __d('users', 'Verify you didn\'t made a typo')]]);
echo $this->Form->input('bio', ['label' => __d('elabs', 'About...'), 'type' => 'textarea', 'templateVars' => ['help' => __d('users', 'Tell us why you want to come here')]]);
echo $this->Form->submit(__d('elabs', 'Register'), ['class' => 'btn-block']);
echo $this->Form->end();
