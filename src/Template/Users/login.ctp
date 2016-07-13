<?php $this->assign('title', __d('elabs', 'Login')); ?>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel">
            <div class="panel-heading">
                <h3><?php echo __d('elabs', 'Login') ?></h3>
                <div class="panel-body">
                    <div class="text-center">
                        <span class="fa-stack fa-5x">
                            <i class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa fa-user fa-stack-1x text-brand"></i>
                        </span>
                    </div>
                    <?php echo $this->element('users/loginform') ?>
                </div>
            </div>
        </div>
    </div>
</div>

