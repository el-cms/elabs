<?php
/*
 * File:
 *   src/Templates/Users/login.ctp
 * Description:
 *   Login view
 * Layout element: none
 */

// Page title
$this->assign('title', __d('elabs', 'Password reset'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Password reset'));
?>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel">
            <div class="panel-body text-center">
                <span class="fa-stack fa-5x">
                    <?php
                    echo $this->Html->icon('circle-o stack-2x');
                    echo $this->Html->icon('user stack-1x', ['class' => 'text-primary'])
                    ?>
                </span>
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create('User') ?>
                <fieldset>
                    <legend><?= __d('elabs', 'Please enter your email to reset your password') ?></legend>
                    <?= $this->Form->input('reference') ?>
                </fieldset>
                <?= $this->Form->button(__d('elabs', 'Send new password'), ['class'=>'btn btn-primary']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
