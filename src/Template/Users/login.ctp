<?php
/*
 * File:
 *   src/Templates/Users/login.ctp
 * Description:
 *   Login view
 * Layout element: none
 */

// Page title
$this->assign('title', __d('elabs', 'Login'));

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
                    echo $this->Html->icon('user stack-1x', ['class' => 'text-primary'])
                    ?>
                </span>
                <?php echo $this->element('users/loginform') ?>
            </div>
        </div>
    </div>
</div>

