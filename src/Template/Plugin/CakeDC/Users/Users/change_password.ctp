<?php
// Page title
$this->assign('title', __d('elabs', 'New password'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Login'));
?>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel">
            <div class="panel-body text-center">
                <span class="fa-stack fa-5x">
                    <?php
                    echo $this->Html->icon('circle-o stack-2x');
                    echo $this->Html->icon('user stack-1x', ['class' => 'text-primary']);
                    ?>
                </span>
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create($user) ?>
                <legend><?= __d('elabs', 'Please enter the new password') ?></legend>
                <?= $this->Form->input('password'); ?>
                <?= $this->Form->input('password_confirm', ['type' => 'password', 'required' => true]); ?>

                <?= $this->Html->link($this->Html->iconT('chevron-left', __d('elabs', 'Cancel and login')), ['Plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'login'], ['class'=>'btn btn-warning', 'escape'=>false]); ?>
                <?= $this->Form->button(__d('elabs', 'Change the password'), ['class'=>'btn btn-primary']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
