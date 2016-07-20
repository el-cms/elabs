<?php
/*
 * File:
 *   src/Templates/Users/register.ctp
 * Description:
 *   Register view
 * Layout element: none
 */

// Page title
$this->assign('title', __d('elabs', 'Register'));
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2 text-center">
                        <span class="fa-stack fa-2x">
                          <?php
                          echo $this->Html->icon('circle-o stack-2x');
                          echo $this->Html->icon('user-plus stack-1x', ['class' => 'text-primary']);
                          ?>
                        </span>
                    </div>
                    <div class="col-xs-10">
                        <?php echo $this->element('users/manifest') ?>
                    </div>
                </div>
                <?php echo $this->element('users/registerform') ?>
            </div>
        </div>
    </div>
</div>
